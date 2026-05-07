<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Register app SSH key details. */
class BitriseRegisterSshKey extends AbstractBitriseTool { protected const NAME = 'bitrise_register_ssh_key'; protected const DESCRIPTION = 'Register SSH key details for an app during setup.'; protected const METHOD = 'registerSshKey'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
