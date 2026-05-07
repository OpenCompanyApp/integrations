<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a page of audit events from the last 90 days. If you want to retrieve data that is older than 90 days, you can use the CSV export feature. Required scope auditlogs:read Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint GET /v2/audit/logs.
 */
class MiroEnterpriseGetAuditLogs extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_audit_logs';
    protected const DESCRIPTION = 'Retrieves a page of audit events from the last 90 days. If you want to retrieve data that is older than 90 days, you can use the CSV export feature. Required scope auditlogs:read Rate limiting Level 2

Official Miro endpoint: GET /v2/audit/logs.';
    protected const PARAMETERS = array (
      'created_after' => array (
        'type' => 'string',
        'description' => 'Retrieve audit logs created after the date and time provided. This is the start date of the duration for which you want to retrieve audit logs. For example, if you want to retrieve audit logs between `2023-03-30T17:26:50.000Z` and `2023-04-30T17:26:50.000Z`, provide `2023-03-30T17:26:50.000Z` as the value for the `createdAfter` parameter. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), including milliseconds and a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC))."',
        'required' => true,
      ),
      'created_before' => array (
        'type' => 'string',
        'description' => 'Retrieve audit logs created before the date and time provided. This is the end date of the duration for which you want to retrieve audit logs. For example, if you want to retrieve audit logs between `2023-03-30T17:26:50.000Z` and `2023-04-30T17:26:50.000Z`, provide `2023-04-30T17:26:50.000Z` as the value for the `createdBefore` parameter. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), including milliseconds and a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC)).',
        'required' => true,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A cursor-paginated method returns a portion of the total set of results based on the `limit` specified and a `cursor` that points to the next portion of the results. To retrieve the next set of results of the collection, set the `cursor` parameter in your next request to the appropriate cursor value returned in the response.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'Maximum number of results returned based on the `limit` specified in the request. For example, if there are `30` results, the request has no `cursor` value, and the `limit` is set to `20`,the `size` of the results will be `20`. The rest of the results will not be returned. To retrieve the rest of the results, you must make another request and set the appropriate value for the `cursor` parameter value that you obtained from the response. Default: `100`',
        'required' => false,
      ),
      'sorting' => array (
        'type' => 'string',
        'description' => 'Sort order in which you want to view the result set. Based on the value you provide, the results are sorted in an ascending or descending order of the audit log creation date (audit log `createdAt` parameter). Default: `ASC`',
        'required' => false,
        'enum' => array (
          'ASC',
          'DESC',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/audit/logs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'createdAfter' => 'created_after',
      'createdBefore' => 'created_before',
      'cursor' => 'cursor',
      'limit' => 'limit',
      'sorting' => 'sorting',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
