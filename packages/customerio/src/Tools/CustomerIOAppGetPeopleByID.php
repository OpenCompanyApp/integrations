<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Return attributes and devices for up to 100 customers by ID.
 */
class CustomerIOAppGetPeopleByID extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_people_by_id';
}
