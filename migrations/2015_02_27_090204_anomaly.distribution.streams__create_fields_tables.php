<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/**
 * Class AnomalyDistributionStreamsCreateFieldsTables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyDistributionStreamsCreateFieldsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* @var Builder $schema */
        $schema = app('db')->connection()->getSchemaBuilder();

        $schema->create(
            'streams_fields',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('namespace');
                $table->string('slug');
                $table->string('name');
                $table->string('type');
                $table->text('config');
                $table->text('rules');
                $table->boolean('locked')->default(0);
            }
        );

        $schema->create(
            'streams_fields_translations',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('field_id');
                $table->string('locale')->index();

                $table->string('name');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* @var Builder $schema */
        $schema = app('db')->connection()->getSchemaBuilder();

        $schema->dropIfExists('streams_fields');
        $schema->dropIfExists('streams_fields_translations');
    }
}
