<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Illuminate\Database\Schema\Blueprint;

class InstallStreamsTablesCommandHandler
{
    protected $db;

    protected $schema;

    function __construct()
    {
        $this->db     = app('db');
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    public function handle(InstallStreamsTablesCommand $command)
    {
        $this->installStreamsTable();
        $this->installStreamsTranslationsTable();

        $this->installFieldsTable();
        $this->installFieldsTranslationsTable();

        $this->installAssignmentsTable();
        $this->installAssignmentsTranslationsTable();
    }

    protected function installStreamsTable()
    {
        $this->schema->dropIfExists('streams_streams');

        $this->schema->create(
            'streams_streams',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('namespace');
                $table->string('slug');
                $table->string('prefix')->nullable();
                $table->string('name');
                $table->string('description')->nullable();
                $table->text('view_options');
                $table->string('title_column');
                $table->string('order_by');
                $table->string('is_hidden')->default(0);
                $table->string('is_translatable')->default(0);
                $table->string('is_revisionable')->default(0);

            }
        );
    }

    protected function installStreamsTranslationsTable()
    {
        $this->schema->dropIfExists('streams_streams_translations');

        $this->schema->create(
            'streams_streams_translations',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('stream_id');
                $table->string('locale')->index();

                $table->string('name');
                $table->string('description')->nullable();

            }
        );
    }

    protected function installFieldsTable()
    {
        $this->schema->dropIfExists('streams_fields');

        $this->schema->create(
            'streams_fields',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('namespace');
                $table->string('slug');
                $table->string('name');
                $table->string('type');
                $table->text('settings');
                $table->text('rules');
                $table->boolean('is_locked')->default(0);

            }
        );
    }

    protected function installFieldsTranslationsTable()
    {
        $this->schema->dropIfExists('streams_fields_translations');

        $this->schema->create(
            'streams_fields_translations',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('field_id');
                $table->string('locale')->index();

                $table->string('name');

            }
        );
    }

    protected function installAssignmentsTable()
    {
        $this->schema->dropIfExists('streams_assignments');

        $this->schema->create(
            'streams_assignments',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('sort_order');
                $table->integer('stream_id');
                $table->integer('field_id');
                $table->string('label')->nullable();
                $table->string('placeholder')->nullable();
                $table->text('instructions')->nullable();
                $table->boolean('is_unique')->default(0);
                $table->boolean('is_required')->default(0);
                $table->boolean('is_translatable')->default(0);
                $table->boolean('is_revisionable')->default(0);

            }
        );
    }

    protected function installAssignmentsTranslationsTable()
    {
        $this->schema->dropIfExists('streams_assignments_translations');

        $this->schema->create(
            'streams_assignments_translations',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('assignment_id');
                $table->string('locale')->index();

                $table->string('label')->nullable();
                $table->string('placeholder')->nullable();
                $table->text('instructions')->nullable();

            }
        );
    }
}
