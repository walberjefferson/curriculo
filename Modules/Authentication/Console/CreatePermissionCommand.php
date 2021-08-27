<?php

namespace Authentication\Console;

use Illuminate\Console\Command;
use Authentication\Facade\PermissionReader;
use Authentication\Models\Permission;
use Authentication\Repositories\PermissionRepository;

class CreatePermissionCommand extends Command
{
    protected $name = 'authentication:make-permission';
    protected $description = 'Criação de permissões baseado em controllers e actions';

    private $repository;

    public function __construct(PermissionRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = PermissionReader::getPermissions();
        foreach ($permissions as $permission) {
            $this->repository->updateOrCreate(['name' => $permission['name'], 'resource_name' => $permission['resource_name']], $permission);
        }
        $this->info("####  Permissões Carregadas.  ####");
    }
}
