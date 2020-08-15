<?php

use Mim\Library\Fs;
use CliApp\Library\Config;
use CliApp\Library\Syncer;
use Cli\Library\Bash;

class Installer
{
    private $modules = ['core', 'cli', 'cli-app'];
    private $here;
    private $tmp; 
    
    private function echo($str){
        echo $str . PHP_EOL;
    }
    
    private function error($msg){
        $this->echo('Error: ' . $msg);
        exit;
    }
    
    private function checkSystem(){
        $cmds = ['wget', 'unzip'];
        
        foreach($cmds as $cmd){
            if(!$this->run('which ' . $cmd))
                $this->error('The installer require `' . $cmd . '` to be installed');
        }
    }
    
    private function cleanUpTmp(){
        $this->echo('Cleanup temporary files');
        Fs::rmdir($this->here . '/.tmp');
        unlink($this->here . '/installer.php');
    }

    private function copyMimAutocomplete(){
        $copy = readline('Would you like me to add autocompletet to your system? (Y/n): ');
        if(!$copy)
            $copy = 'y';
            
        if(strtolower(substr($copy,0,1)) !== 'y')
            return false;

        $default = $this->getBashCompletionDir();
        $target = readline('Where to put the autocompleter? ('.$default.'): ');
        if(!$target)
            $target = $default;
        $target = chop($target, '/') . '/';

        // copy autocomplete
        $this->echo('Creating bash autocomplete symlink');
        $cmd = 'sudo ln -s ' . $this->here . '/etc/bash/au.sh '.$target.'/mim';
        $this->run($cmd);

        $this->echo('Autocomplete successfully installed');
    }
    
    private function copyMimToPath(){
        $cmd = 'chmod +x ' . $this->here . '/mim';
        $this->run($cmd);

        $bin_path = $this->getBinPath();
        
        $copy = readline('Would you like me to add the mim to your `' . $bin_path . '` dir? (Y/n): ');
        
        if(!$copy)
            $copy = 'y';
            
        if(strtolower(substr($copy,0,1)) !== 'y')
            return false;

        // copy the caller
        $this->echo('Creating mim symlink');
        $cmd = 'sudo ln -s ' . $this->here . '/mim ' . $bin_path . '/mim';
        $this->run($cmd);
        
        return true;
    }
    
    private function fetchModules(){
        foreach($this->modules as $mod){
            $this->echo('Prepare module `' . $mod . '`...');
            $zip_url = 'https://github.com/getmim/' . $mod . '/archive/master.zip';
            $cmds = [
                'cd ' . $this->tmp,
                'wget -q ' . $zip_url,
                'unzip -q master.zip',
                'rm master.zip',
                'mv ' . $mod . '-master ' . $mod
            ];
            $cmd = implode(' && ', $cmds);
            $this->run($cmd);
        }
    }
    
    private function generateConfigMainFile(){
        $nl = PHP_EOL;
        
        $this->echo('Generate `etc/config/main.php` files');
        
        $tx = '<?php' . $nl;
        $tx.= $nl;
        $tx.= 'return ';
        $tx.= to_source([
            'name' => 'Mim: PHP Framework',
            'version' => '0.0.1',
            'host' => '',
            'timezone' => 'Asia/Jakarta',
            'install' => date('Y-m-d H:i:s'),
            'secure' => false
        ]);
        $tx.= ';';
        
        Fs::write($this->here . '/etc/config/main.php', $tx);
    }
    
    private function generateGeneralConfig(){
        $this->echo('Generate global config cache');
        Config::init($this->here);
    }
    
    private function generateModulesFile(){
        $nl = PHP_EOL;
        $this->echo('Generate `etc/modules.php` files');
        
        $tx = '<?php' . $nl;
        $tx.= $nl;
        $tx.= 'return ';
        $tx.= to_source([
            'core'    => 'git@github.com:getmim/core.git',
            'cli'     => 'git@github.com:getmim/cli.git',
            'cli-app' => 'git@github.com:getmim/cli-app.git'
        ]);
        $tx.= ';';
        
        Fs::write($this->here . '/etc/modules.php', $tx);
    }

    private function getBashCompletionDir(): string{
        $target = '/etc/bash_completion.d';
        if($this->osIs('mac'))
            $target = '/usr/local/etc/bash_completion.d';

        return $target;
    }

    private function getBinPath(): string{
        $target = '/usr/bin';
        if($this->osIs('mac'))
            $target = '/usr/local/bin';

        return $target;
    }
    
    private function loadRequiredFiles(){
        $this->echo('Requiring required files');
        $req_files = [
            $this->tmp . '/core/modules/core/helper/global.php',
            $this->tmp . '/core/modules/core/library/Fs.php',
            
            $this->tmp . '/cli/modules/cli/library/Bash.php',
            
            $this->tmp . '/cli-app/modules/cli-app/library/Syncer.php',
            $this->tmp . '/cli-app/modules/cli-app/library/Config.php',
            $this->tmp . '/cli-app/modules/cli-app/library/AutoloadParser.php'
        ];
        foreach($req_files as $file)
            require_once $file;
    }

    private function osIs(string $name): bool{
        if(stristr(PHP_OS, 'DAR')   && $name == 'mac')
            return true;
        if(stristr(PHP_OS, 'LINUX') && $name == 'linux')
            return true;
        if(stristr(PHP_OS, 'WIN')   && $name == 'windows')
            return true;
        return false;
    }
    
    private function prepareTmp(){
        $this->echo('Prepare temporary dir');
        if(is_dir($this->tmp))
            $this->run('rm -Rf ' . $this->tmp);
        $this->run('mkdir ' . $this->tmp);
    }
    
    private function run($cmd){
        return `$cmd`;
    }
    
    private function syncModules(){
        foreach($this->modules as $mod){
            $mod_base = $this->tmp . '/' . $mod;
            $mod_config_file = $mod_base . '/modules/' . $mod . '/config.php';
            $mod_config = include $mod_config_file;
            
            $this->echo('Syncing module `' . $mod . '`');
            Syncer::sync($mod_base, $this->here, $mod_config['__files'], 'install');
        }
    }
    
    public function __construct(){
        $this->here = getcwd();
        $this->tmp  = $this->here . '/.tmp';
    }
    
    public function init(){
        $this->checkSystem();
        $this->prepareTmp();
        $this->fetchModules();
        $this->loadRequiredFiles();
        $this->syncModules();
        $this->cleanUpTmp();
        $this->generateModulesFile();
        $this->generateConfigMainFile();
        $this->generateGeneralConfig();
        $copied = $this->copyMimToPath();
        
        $command = $copied ? 'mim' : './mim';
        
        $this->echo('MIM Tools successfully installed, try run `' . $command . ' version` just to make sure.');

        $this->copyMimAutocomplete();
    }
}

(new Installer)->init();