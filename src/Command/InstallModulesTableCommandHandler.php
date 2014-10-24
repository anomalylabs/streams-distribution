<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Illuminate\Database\Schema\Blueprint;

class InstallModulesTableCommandHandler
{
    protected $db;

    protected $schema;

    function __construct()
    {
        $this->db     = app('db');
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    public function handle(InstallModulesTableCommand $command)
    {
        $this->installModulesTable();
    }

    protected function installModulesTable()
    {
        $this->schema->dropIfExists('addons_modules');

        $this->schema->create(
            'addons_modules',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('slug');
                $table->boolean('is_installed')->default(0);
                $table->string('is_enabled')->default(0);

            }
        );
    }
}
 