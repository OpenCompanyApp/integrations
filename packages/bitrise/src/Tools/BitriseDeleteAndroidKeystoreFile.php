<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Delete an Android keystore file from a Bitrise app. */
class BitriseDeleteAndroidKeystoreFile extends AbstractBitriseTool { protected const NAME = 'bitrise_delete_android_keystore_file'; protected const DESCRIPTION = 'Delete an Android keystore file from a Bitrise app.'; protected const METHOD = 'deleteAndroidKeystoreFile'; protected const ARGUMENTS = ['app_slug', 'file_slug']; }
