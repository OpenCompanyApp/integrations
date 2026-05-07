<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be consid...
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /baseUris.
 */
class AdobeAcrobatSignBaseUrisGetBaseUris extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_base_uris_get_base_uris';
    protected const DESCRIPTION = 'Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be consid...

Official Adobe Acrobat Sign endpoint: GET /baseUris

Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be considered an invalid request.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/baseUris';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
