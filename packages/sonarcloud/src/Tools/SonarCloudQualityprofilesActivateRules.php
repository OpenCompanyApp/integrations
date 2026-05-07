<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Bulk-activate rules on one quality profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/activate_rules.
 */
class SonarCloudQualityprofilesActivateRules extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_activate_rules';
    protected const DESCRIPTION = 'Bulk-activate rules on one quality profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/activate_rules.';
    protected const PARAMETERS = array (
      'activation' => array (
        'type' => 'string',
        'description' => 'Filter rules that are activated or deactivated on the selected Quality profile. Ignored if the parameter \'qprofile\' is not set.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'active_severities' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of activation severities, i.e the severity of rules in Quality profiles.',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
      'asc' => array (
        'type' => 'string',
        'description' => 'Ascending sort',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'available_since' => array (
        'type' => 'string',
        'description' => 'Filters rules added since date. Format is yyyy-MM-dd',
        'required' => false,
      ),
      'clean_code_attribute_categories' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of Clean Code Attribute Categories',
        'required' => false,
        'enum' => array (
          'ADAPTABLE',
          'CONSISTENT',
          'INTENTIONAL',
          'RESPONSIBLE',
        ),
      ),
      'cwe' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of CWE identifiers. Use \'unknown\' to select rules not associated to any CWE.',
        'required' => false,
      ),
      'impact_severities' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of Software Quality Severities',
        'required' => false,
        'enum' => array (
          'INFO',
          'LOW',
          'MEDIUM',
          'HIGH',
          'BLOCKER',
        ),
      ),
      'impact_software_qualities' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of Software Qualities',
        'required' => false,
        'enum' => array (
          'MAINTAINABILITY',
          'RELIABILITY',
          'SECURITY',
        ),
      ),
      'inheritance' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of values of inheritance for a rule within a quality profile. Used only if the parameter \'activation\' is set.',
        'required' => false,
        'enum' => array (
          'NONE',
          'INHERITED',
          'OVERRIDES',
        ),
      ),
      'is_template' => array (
        'type' => 'string',
        'description' => 'Filter template rules',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'languages' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of languages',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => false,
      ),
      'owasp_mobile_top10_2024' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of OWASP Mobile Top 10 (2024) lowercase categories.',
        'required' => false,
        'enum' => array (
          'm1',
          'm2',
          'm3',
          'm4',
          'm5',
          'm6',
          'm7',
          'm8',
          'm9',
          'm10',
        ),
      ),
      'owasp_top10' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of OWASP Top 10 lowercase categories.',
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
        'description' => 'Comma-separated list of OWASP Top 10 (2021) lowercase categories.',
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
      'q' => array (
        'type' => 'string',
        'description' => 'UTF-8 search query',
        'required' => false,
      ),
      'qprofile' => array (
        'type' => 'string',
        'description' => 'Quality profile key to filter on. Used only if the parameter \'activation\' is set.',
        'required' => false,
      ),
      'repositories' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of repositories',
        'required' => false,
      ),
      'rule_key' => array (
        'type' => 'string',
        'description' => 'Key of rule to search for',
        'required' => false,
      ),
      's' => array (
        'type' => 'string',
        'description' => 'Sort field',
        'required' => false,
        'enum' => array (
          'name',
          'updatedAt',
          'createdAt',
          'key',
        ),
      ),
      'severities' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of default severities. Not the same than severity of rules in Quality profiles.',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
      'sonarsource_security' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of SonarSource security categories. Use \'others\' to select rules not associated with any category',
        'required' => false,
        'enum' => array (
          'buffer-overflow',
          'permission',
          'sql-injection',
          'command-injection',
          'path-traversal-injection',
          'ldap-injection',
          'xpath-injection',
          'rce',
          'dos',
          'ssrf',
          'csrf',
          'xss',
          'log-injection',
          'http-response-splitting',
          'open-redirect',
          'xxe',
          'object-injection',
          'weak-cryptography',
          'auth',
          'insecure-conf',
          'encrypt-data',
          'traceability',
          'file-manipulation',
          'others',
        ),
      ),
      'statuses' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of status codes',
        'required' => false,
        'enum' => array (
          'BETA',
          'DEPRECATED',
          'READY',
          'REMOVED',
        ),
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of tags. Returned rules match any of the tags (OR operator)',
        'required' => false,
      ),
      'target_key' => array (
        'type' => 'string',
        'description' => 'Quality Profile key on which the rule activation is done. To retrieve a quality profile key please see api/qualityprofiles/search',
        'required' => true,
      ),
      'target_severity' => array (
        'type' => 'string',
        'description' => 'Severity to set on the activated rules',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
      'template_key' => array (
        'type' => 'string',
        'description' => 'Key of the template rule to filter on. Used to search for the custom rules based on this template.',
        'required' => false,
      ),
      'types' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of types. Returned rules match any of the tags (OR operator)',
        'required' => false,
        'enum' => array (
          'CODE_SMELL',
          'BUG',
          'VULNERABILITY',
          'SECURITY_HOTSPOT',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/activate_rules';
    protected const PARAM_MAP = array (
      'activation' => 'activation',
      'active_severities' => 'active_severities',
      'asc' => 'asc',
      'available_since' => 'available_since',
      'cleanCodeAttributeCategories' => 'clean_code_attribute_categories',
      'cwe' => 'cwe',
      'impactSeverities' => 'impact_severities',
      'impactSoftwareQualities' => 'impact_software_qualities',
      'inheritance' => 'inheritance',
      'is_template' => 'is_template',
      'languages' => 'languages',
      'organization' => 'organization',
      'owaspMobileTop10-2024' => 'owasp_mobile_top10_2024',
      'owaspTop10' => 'owasp_top10',
      'owaspTop10-2021' => 'owasp_top10_2021',
      'q' => 'q',
      'qprofile' => 'qprofile',
      'repositories' => 'repositories',
      'rule_key' => 'rule_key',
      's' => 's',
      'severities' => 'severities',
      'sonarsourceSecurity' => 'sonarsource_security',
      'statuses' => 'statuses',
      'tags' => 'tags',
      'targetKey' => 'target_key',
      'targetSeverity' => 'target_severity',
      'template_key' => 'template_key',
      'types' => 'types',
    );
}
