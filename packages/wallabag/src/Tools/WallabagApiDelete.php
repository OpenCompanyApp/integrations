<?php
namespace OpenCompany\Integrations\Wallabag\Tools;
/** Execute a safe relative wallabag DELETE call. */
class WallabagApiDelete extends AbstractWallabagRawTool { protected const NAME = 'wallabag_api_delete'; protected const DESCRIPTION = 'Call a safe relative wallabag DELETE path.'; protected const METHOD = 'apiDelete'; }
