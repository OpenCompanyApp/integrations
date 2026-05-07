<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Star an Instapaper bookmark. */
class InstapaperStarBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_star_bookmark'; protected const DESCRIPTION = 'Star an Instapaper bookmark by bookmark_id.'; protected const OPERATION = 'star_bookmark'; protected const REQUIRED = ['bookmark_id']; }
