<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Returns security related audits of this SonarQube instance. Logs are returned in JSON format. Requires the system administration permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/audit_logs/download.
 */
class SonarQubeAuditLogsDownload extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_audit_logs_download';
    protected const DESCRIPTION = 'Returns security related audits of this SonarQube instance. Logs are returned in JSON format. Requires the system administration permission

Official SonarQube Web API endpoint: GET /api/audit_logs/download.';
    protected const PARAMETERS = array (
      'from' => array (
        'type' => 'string',
        'description' => 'Date in ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hh:mm) from which the logs will be returned. Inclusive.',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Date in ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hh:mm) until which the logs will be returned. Inclusive.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/audit_logs/download';
    protected const PARAM_MAP = array (
      'from' => 'from',
      'to' => 'to',
    );
}
