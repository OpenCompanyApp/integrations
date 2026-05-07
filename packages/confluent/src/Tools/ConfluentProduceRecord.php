<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Produce records to the given topic, returning delivery reports for each record produced. This API can be used in streaming mode by setting "Transfer-Encoding: chunked" header. For as long as the connection is kept open, the server will keep accepting records. Records are streamed to and from the server as Concatenated JSON. For each record sent to the server, the server will asynchronously send back a delivery report, in the same order, each with its own errorcode. An errorcode of 200 indicates success. The HTTP status code will be HTTP 200 OK as long as the connection is successfully established. To identify records that have encountered an error, check the errorcode of each delivery report. Note that the clusterid is validated only when running in Confluent Cloud. This API currently does not support Schema Registry integration. Sending schemas is not supported. Only BINARY, JSON, and STRING formats are supported.
 */
class ConfluentProduceRecord extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_produce_record';
}
