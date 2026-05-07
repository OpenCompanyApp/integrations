<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Remove a star from an Instapaper bookmark. */
class InstapaperUnstarBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_unstar_bookmark'; protected const DESCRIPTION = 'Remove the star from an Instapaper bookmark by bookmark_id.'; protected const OPERATION = 'unstar_bookmark'; protected const REQUIRED = ['bookmark_id']; }
