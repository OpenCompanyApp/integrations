<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Create or update a Bitrise app secret. */
class BitrisePutSecret extends AbstractBitriseTool { protected const NAME = 'bitrise_put_secret'; protected const DESCRIPTION = 'Create or update a Bitrise app secret.'; protected const METHOD = 'putSecret'; protected const ARGUMENTS = ['app_slug', 'secret_name']; protected const REQUIRED = ['app_slug', 'secret_name', 'payload']; protected const USE_PAYLOAD = true; }
