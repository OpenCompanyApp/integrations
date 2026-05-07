<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Create an Android keystore file upload record. */
class BitriseCreateAndroidKeystoreFile extends AbstractBitriseTool { protected const NAME = 'bitrise_create_android_keystore_file'; protected const DESCRIPTION = 'Create an Android keystore file upload record for a Bitrise app.'; protected const METHOD = 'createAndroidKeystoreFile'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
