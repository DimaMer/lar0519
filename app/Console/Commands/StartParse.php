<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ParseFunction\RequestSite;
use App\ParseFunction\ParseJobs;
use App\ParseFunction\SaveJob;
use App\ParseFunction\RequestCompany;
use App\ParseFunction\ParseCompany;
use App\ParseFunction\SaveCompany;

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
            $count = $this->ask('How many need jobs par1sing?');
            if (is_numeric($count)) break;
        }

        $this->line("you wrote: " . $count);
        $requestControl = new RequestSite();
        $parseControl = new ParseJobs();
        $saveParseBase = new SaveJob();


        $getLinkJob = $requestControl->getLinkJob($configure['httpsVacancy'], $count);

        $this->output->progressStart(count($getLinkJob));
        foreach ($getLinkJob as $linkJob) {
            $this->info('');
            $resultDom = $requestControl->getJobDom($linkJob);
            $resultParseJob[$linkJob] = $parseControl->getParseJob($resultDom, $linkJob, $configure['searchClassesVacancies']);
            $this->info("download: - " . $linkJob);
            $saveParseBase->saveParseJob($resultParseJob[$linkJob], $linkJob);
            $this->info("parsed: - " . preg_replace("|[^0-9]|", "", $linkJob));
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
        $requestCompany = new RequestCompany();
        $parseCompany = new ParseCompany();
        $saveCompany = new SaveCompany();

        $linkCompanies = $requestCompany->getCompaniesLink();

        foreach ($linkCompanies as $linkCompany) {

            $resultDomCompany = $requestCompany->getCompanyDom($linkCompany);
            $resultParseCompany[$linkCompany] = $parseCompany->getParseCompany($resultDomCompany, $linkCompany, $configure['searchCompanies']);
            $saveCompany->saveCompany($resultParseCompany[$linkCompany], $linkCompany);
        }


    }
}
