<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sys_doc_type');
			$table->string('sys_doc_label');
			$table->string('sys_doc_role');
			$table->boolean('sys_doc_disabled')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_types');
	}

}
