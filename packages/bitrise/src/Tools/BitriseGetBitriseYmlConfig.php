<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get bitrise.yml storage configuration. */
class BitriseGetBitriseYmlConfig extends AbstractBitriseTool { protected const NAME = 'bitrise_get_bitrise_yml_config'; protected const DESCRIPTION = 'Get whether app configuration YAML is stored on bitrise.io or in the repository.'; protected const METHOD = 'getBitriseYmlConfig'; protected const ARGUMENTS = ['app_slug']; }
