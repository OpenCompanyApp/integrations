<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Upload app bitrise.yml. */
class BitriseUploadBitriseYml extends AbstractBitriseTool { protected const NAME = 'bitrise_upload_bitrise_yml'; protected const DESCRIPTION = 'Upload or replace the bitrise.yml configuration for an app.'; protected const METHOD = 'uploadBitriseYml'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
