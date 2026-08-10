# Google Slides

Google Slides tools are exposed under `app.integrations.google_slides`. This package is generated from Google's official Slides API v1 Discovery document and exposes 5 REST methods.

## Coverage

- Source: `https://slides.googleapis.com/$discovery/rest?version=v1`
- Read tools: 3
- Write tools: 2
- Base URL: `https://slides.googleapis.com`

## Usage Notes

Pass `presentationId` and `pageObjectId` path parameters as top-level arguments. Query parameters can be passed as top-level shortcuts or inside `query`. Create and batch update methods accept the official JSON request object inside `body`.

The Slides API does not list presentations; use Drive integration search/list tools when you need discovery by file name or folder.

## Tools

- `google_slides_presentations_get` - GET /v1/presentations/{+presentationId}
- `google_slides_presentations_create` - POST /v1/presentations
- `google_slides_presentations_batch_update` - POST /v1/presentations/{presentationId}:batchUpdate
- `google_slides_presentations_pages_get` - GET /v1/presentations/{presentationId}/pages/{pageObjectId}
- `google_slides_presentations_pages_get_thumbnail` - GET /v1/presentations/{presentationId}/pages/{pageObjectId}/thumbnail

## Examples

```js
var deck = app.integrations.google_slides.google_slides_presentations_get({ presentationId: "1AbC..." })

var result = app.integrations.google_slides.google_slides_presentations_batch_update({
  presentationId: "1AbC...",
  body: { requests: [ { createSlide: {} } ] },
})
```
Responses are decoded Google Slides JSON responses.
