<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM contact fields.
 */
class FreshworksCrmListContactFields extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_contact_fields';
    protected string $toolDescription = 'List Freshworks CRM contact fields.';
    protected string $path = '/api/settings/contacts/fields';
}
