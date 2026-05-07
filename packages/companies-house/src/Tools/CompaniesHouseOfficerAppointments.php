<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List appointments for an officer.
 */
class CompaniesHouseOfficerAppointments extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_officer_appointments';
    protected const DESCRIPTION = 'List all known appointments for an officer identifier.';
    protected const METHOD = 'officerAppointments';
    protected const REQUIRED = ['officer_id'];
    protected const QUERY_KEYS = ['items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'officer_id' => ['type' => 'string', 'required' => true, 'description' => 'Officer identifier from search or officer links.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
