<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM contact filters.
 */
class FreshworksCrmListContactFilters extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_contact_filters';
    protected string $toolDescription = 'List saved contact filters in Freshworks CRM.';
    protected string $path = '/api/contacts/filters';
}
