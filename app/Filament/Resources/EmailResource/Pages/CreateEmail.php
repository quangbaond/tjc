<?php

namespace App\Filament\Resources\EmailResource\Pages;

use App\Filament\Resources\EmailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmail extends CreateRecord
{
    protected static string $resource = EmailResource::class;

    protected function afterCreate(): void
    {
        if(PHP_OS === 'Linux') {
            // get data from form
            $data = $this->form->getRecord()->toArray();
            // run shell script
            $commands = ["sudo useradd -m -s /sbin/nologin {$data['username']} |"];
            $commands[] = "sudo passwd {$data['username']} |";
            // set password
            $commands[] = "echo {$data['password']} |";
            $commands[] = "echo {$data['password']}";
            // run exec
            exec(implode(' | ', $commands));
        }
    }
}
