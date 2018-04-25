<?php

namespace App\Console\Commands;

use App\Model\Schedule;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Calendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Book Calender Auto';

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
//        Log::info('i was here @'.Carbon::now());
      $book= new Schedule();
      $book->address='Sân Bạch Đăng';
      $book->time=date('Y-m-d 18:00:00',strtotime('+6 day'));
      $book->type_id=1;
      $book->manager_id=1;
      $book->created_at=date('Y-m-d H:i:s');
      $book->updated_at=date('Y-m-d H:i:s');
      $book->Save();

    }
}
