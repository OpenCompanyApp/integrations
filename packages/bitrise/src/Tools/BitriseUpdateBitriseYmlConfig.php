<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Update bitrise.yml storage configuration. */
class BitriseUpdateBitriseYmlConfig extends AbstractBitriseTool { protected const NAME = 'bitrise_update_bitrise_yml_config'; protected const DESCRIPTION = 'Update whether app configuration YAML is stored on bitrise.io or in the repository.'; protected const METHOD = 'updateBitriseYmlConfig'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
