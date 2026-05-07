<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for Security Hotpots. Requires the 'Browse' permission on the specified project(s). For applications, it also requires 'Browse' permission on its child projects. When issue indexing is in progress returns 503 service unavailable HTTP code..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/hotspots/search.
 */
class SonarQubeHotspotsSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_hotspots_search';
    protected const DESCRIPTION = 'Search for Security Hotpots. Requires the \'Browse\' permission on the specified project(s). For applications, it also requires \'Browse\' permission on its child projects. When issue indexing is in progress returns 503 service unavailable HTTP code.

Official SonarQube Web API endpoint: GET /api/hotspots/search.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. Not available in the community edition.',
        'required' => false,
      ),
      'casa' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of CASA categories.',
        'required' => false,
      ),
      'compliance_standards' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of compliance standards',
        'required' => false,
      ),
      'cwe' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of CWE numbers',
        'required' => false,
      ),
      'files' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of files. Returns only hotspots found in those files',
        'required' => false,
      ),
      'hotspots' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of Security Hotspot keys. This parameter is required unless project is provided.',
        'required' => false,
      ),
      'in_new_code_period' => array (
        'type' => 'string',
        'description' => 'If \'inNewCodePeriod\' is provided, only Security Hotspots created in the new code period are returned.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'only_mine' => array (
        'type' => 'string',
        'description' => 'If \'projectKey\' is provided, returns only Security Hotspots assigned to the current user',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'owasp_asvs_4_0' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of OWASP ASVS v4.0 categories or rules.',
        'required' => false,
      ),
      'owasp_asvs_level' => array (
        'type' => 'string',
        'description' => 'Filters hotspots with lower or equal OWASP ASVS level to the parameter value. Should be used in combination with the \'owaspAsvs-4.0\' parameter.',
        'required' => false,
        'enum' => array (
          '1',
          '2',
          '3',
        ),
      ),
      'owasp_top10' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of OWASP 2017 Top 10 lowercase categories.',
        'required' => false,
        'enum' => array (
          'a1',
          'a2',
          'a3',
          'a4',
          'a5',
          'a6',
          'a7',
          'a8',
          'a9',
          'a10',
        ),
      ),
      'owasp_top10_2021' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of OWASP 2021 Top 10 lowercase categories.',
        'required' => false,
        'enum' => array (
          'a1',
          'a2',
          'a3',
          'a4',
          'a5',
          'a6',
          'a7',
          'a8',
          'a9',
          'a10',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'pci_dss_3_2' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of PCI DSS v3.2 categories.',
        'required' => false,
      ),
      'pci_dss_4_0' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of PCI DSS v4.0 categories.',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Key of the project or application. This parameter is required unless hotspots is provided.',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0.',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id. Not available in the community edition.',
        'required' => false,
      ),
      'resolution' => array (
        'type' => 'string',
        'description' => 'If \'project\' is provided and if status is \'REVIEWED\', only Security Hotspots with the specified resolution are returned.',
        'required' => false,
        'enum' => array (
          'FIXED',
          'SAFE',
          'ACKNOWLEDGED',
        ),
      ),
      'sans_top25' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of SANS Top 25 categories.',
        'required' => false,
        'enum' => array (
          'insecure-interaction',
          'risky-resource',
          'porous-defenses',
        ),
      ),
      'sonarsource_security' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of SonarSource security categories. Use \'others\' to select issues not associated with any category',
        'required' => false,
        'enum' => array (
          'malicious-dependencies',
          'buffer-overflow',
          'sql-injection',
          'rce',
          'object-injection',
          'command-injection',
          'path-traversal-injection',
          'ldap-injection',
          'xpath-injection',
          'log-injection',
          'xxe',
          'xss',
          'dos',
          'ssrf',
          'csrf',
          'http-response-splitting',
          'open-redirect',
          'weak-cryptography',
          'auth',
          'insecure-conf',
          'file-manipulation',
          'encrypt-data',
          'traceability',
          'permission',
          'others',
        ),
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'If \'project\' is provided, only Security Hotspots with the specified status are returned.',
        'required' => false,
        'enum' => array (
          'TO_REVIEW',
          'REVIEWED',
        ),
      ),
      'stig_asd_v5_r3' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of STIG V5R3 lowercase categories.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/hotspots/search';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'casa' => 'casa',
      'complianceStandards' => 'compliance_standards',
      'cwe' => 'cwe',
      'files' => 'files',
      'hotspots' => 'hotspots',
      'inNewCodePeriod' => 'in_new_code_period',
      'onlyMine' => 'only_mine',
      'owaspAsvs-4.0' => 'owasp_asvs_4_0',
      'owaspAsvsLevel' => 'owasp_asvs_level',
      'owaspTop10' => 'owasp_top10',
      'owaspTop10-2021' => 'owasp_top10_2021',
      'p' => 'p',
      'pciDss-3.2' => 'pci_dss_3_2',
      'pciDss-4.0' => 'pci_dss_4_0',
      'project' => 'project',
      'ps' => 'ps',
      'pullRequest' => 'pull_request',
      'resolution' => 'resolution',
      'sansTop25' => 'sans_top25',
      'sonarsourceSecurity' => 'sonarsource_security',
      'status' => 'status',
      'stig-ASD_V5R3' => 'stig_asd_v5_r3',
    );
}
