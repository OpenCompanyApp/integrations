<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get an unprotected Bitrise secret value. */
class BitriseGetSecretValue extends AbstractBitriseTool { protected const NAME = 'bitrise_get_secret_value'; protected const DESCRIPTION = 'Get the value of an unprotected Bitrise app secret.'; protected const METHOD = 'getSecretValue'; protected const ARGUMENTS = ['app_slug', 'secret_name']; }
