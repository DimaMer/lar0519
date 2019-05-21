<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ParseFunction;

class StartParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:parse  {count=1} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = storage_path("configure.json");
            try {
                $contents = file_get_contents($filename);
            } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
                die("The file doesn't exist");
            }
        $configure = json_decode($contents, true);

        while (1) {
            $count = $this->ask('How many need jobs parsing?');
            if (is_numeric($count)) break;
        }

        $this->line("you wrote: " . $count);
        $requestControl = new ParseFunction\RequestSite();
        $parseControl = new ParseFunction\ParseJobs();
        $saveParseBase = new ParseFunction\SaveParse();

        $getLinkJob = $requestControl->getLinkJob($configure['https'], $count);

        $this->output->progressStart(count($getLinkJob));
            foreach ($getLinkJob as $key => $value) {
                $this->info('');
                $resultDom = $requestControl->getJobDom($value);
                $resultParseJob[$value] = $parseControl->getParseJob($resultDom, $value, $configure['searchClasses']);
                $this->info("download: - " . $value);
                $saveParseBase->saveParseJob($resultParseJob[$value], $value);
                $this->info("parsed: - " . preg_replace("|[^0-9]|", "", $value));
                $this->output->progressAdvance();
            }
        $this->output->progressFinish();
    }
}
