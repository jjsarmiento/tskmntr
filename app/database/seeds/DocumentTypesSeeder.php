<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 7/25/2016
 * Time: 11:09 AM
 */

class DocumentTypesSeeder extends Seeder {
    public function run(){
        // NBI
        DocumentType::create([
            'sys_doc_type'      =>  'NBI',
            'sys_doc_label'     =>  'NBI',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // POLICE CLEARANCE
        DocumentType::create([
            'sys_doc_type'      =>  'POLICE_CLEARANCE',
            'sys_doc_label'     =>  'Police Clearance',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // PASSPORT
        DocumentType::create([
            'sys_doc_type'      =>  'PASSPORT',
            'sys_doc_label'     =>  'Passport',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // DRIVER'S LISCENSE
        DocumentType::create([
            'sys_doc_type'      =>  'DRIVERS_LISCENSE',
            'sys_doc_label'     =>  "Driver's Liscense",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // DIPLOMA CERFICATE
        DocumentType::create([
            'sys_doc_type'      =>  'DIPLOMA_CERTIFICATE',
            'sys_doc_label'     =>  "Diploma Certificate",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // Barangay Clearance / Barangay ID
        DocumentType::create([
            'sys_doc_type'      =>  'BARANGAY_CLRNC_ID',
            'sys_doc_label'     =>  "Barangay Clearance / ID",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // TIN ID
        DocumentType::create([
            'sys_doc_type'      =>  'TIN_ID',
            'sys_doc_label'     =>  "TIN ID",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // Old Elementary/Highschool Diploma/ID
        DocumentType::create([
            'sys_doc_type'      =>  'OLD_EL_HS_DIPLOMA_ID',
            'sys_doc_label'     =>  "Old Elementary or Highschool Dimploma or ID",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // NSO BIRTH CERTIFICATE
        DocumentType::create([
            'sys_doc_type'      =>  'NSO_BIRTH_CERT',
            'sys_doc_label'     =>  'NSO Birth Certificate',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // MARRIAGE CONTRACT
        DocumentType::create([
            'sys_doc_type'      =>  'MARRIAGE_CONTRACT',
            'sys_doc_label'     =>  'Marriage Contract',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // Voter's ID
        DocumentType::create([
            'sys_doc_type'      =>  'VOTERS_ID',
            'sys_doc_label'     =>  "Voter's ID",
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // GSIS / SSS ID
        DocumentType::create([
            'sys_doc_type'      =>  'GSIS_SSS_ID',
            'sys_doc_label'     =>  'GSIS or SSS ID',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // PRC / OWWA ID
        DocumentType::create([
            'sys_doc_type'      =>  'PRC_OWWA_ID',
            'sys_doc_label'     =>  'PRC or OWWA ID',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);

        // FORM 137 / TOR
        DocumentType::create([
            'sys_doc_type'      =>  'FORM_137_TOR',
            'sys_doc_label'     =>  'Form 137 or TOR',
            'sys_doc_role'      =>  'WORKER',
            'sys_doc_disabled'  =>  false,
        ]);
    }
}