<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List Bitrise app secrets. */
class BitriseListSecrets extends AbstractBitriseTool { protected const NAME = 'bitrise_list_secrets'; protected const DESCRIPTION = 'List secrets configured for a Bitrise app.'; protected const METHOD = 'listSecrets'; protected const ARGUMENTS = ['app_slug']; }
