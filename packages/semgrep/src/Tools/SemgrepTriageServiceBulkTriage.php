<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Bulk triage.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentSlug}/triage.
 */
class SemgrepTriageServiceBulkTriage extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_triage_service_bulk_triage';
    protected const DESCRIPTION = 'Bulk triage

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentSlug}/triage

Bulk triage your findings. You can select the findings to triage by passing in a list of finding IDs as issue_ids, or by passing in filter query parameters. You must specify the issue_type of the findings you want to bulk triage. One of new_triage_state or new_note is required. If specifying a new_triage_reason, you must also use new_triage_state=ignored. Some filters only apply for findings associated with a given product.';
    protected const PARAMETERS = array (
  'deployment_slug' =>
  array (
    'type' => 'string',
    'description' => 'deploymentSlug parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/triage';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
