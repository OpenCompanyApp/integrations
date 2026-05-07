<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get detailed information about a rule Since 5.5, following fields in the response have been deprecated :- "effortToFixDescription" becomes "gapDescription"; - "debtRemFnCoeff" becomes "remFnGapMultiplier"; - "defaultDebtRemFnCoeff" becomes "defaultRemFnGapMultiplier"; - "debtRemFnOffset" becomes "remFnBaseEffort"; - "defaultDebtRemFnOffset" becomes "defaultRemFnBaseEffort"; - "debtOverloaded" becomes "remFnOverloaded"; In 7.1, the field 'scope' has been added..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/rules/show.
 */
class SonarCloudRulesShow extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_rules_show';
    protected const DESCRIPTION = 'Get detailed information about a rule Since 5.5, following fields in the response have been deprecated :- "effortToFixDescription" becomes "gapDescription"; - "debtRemFnCoeff" becomes "remFnGapMultiplier"; - "defaultDebtRemFnCoeff" becomes "defaultRemFnGapMultiplier"; - "debtRemFnOffset" becomes "remFnBaseEffort"; - "defaultDebtRemFnOffset" becomes "defaultRemFnBaseEffort"; - "debtOverloaded" becomes "remFnOverloaded"; In 7.1, the field \'scope\' has been added.

Official SonarCloud Web API endpoint: GET /api/rules/show.';
    protected const PARAMETERS = array (
      'actives' => array (
        'type' => 'string',
        'description' => 'Show rule\'s activations for all profiles ("active rules")',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Rule key',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/rules/show';
    protected const PARAM_MAP = array (
      'actives' => 'actives',
      'key' => 'key',
      'organization' => 'organization',
    );
}
