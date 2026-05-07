<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Delete a Bitrise app secret. */
class BitriseDeleteSecret extends AbstractBitriseTool { protected const NAME = 'bitrise_delete_secret'; protected const DESCRIPTION = 'Delete a Bitrise app secret.'; protected const METHOD = 'deleteSecret'; protected const ARGUMENTS = ['app_slug', 'secret_name']; }
