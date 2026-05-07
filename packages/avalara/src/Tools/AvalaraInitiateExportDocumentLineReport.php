<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Initiate an ExportDocumentLine report task.
 *
 * Executes the official Avalara AvaTax REST API operation InitiateExportDocumentLineReport.
 */
class AvalaraInitiateExportDocumentLineReport extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_initiate_export_document_line_report';
}