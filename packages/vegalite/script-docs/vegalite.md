# Vega-Lite — JavaScript API Reference

## render_vegalite

Render a Vega-Lite visualization to a PNG image. Pass a complete Vega-Lite JSON specification and get back a markdown image embed. Always use inline data with `"data": {"values": [...]}`. Never use `"data": {"url": "..."}`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `spec` | string | yes | Complete Vega-Lite JSON specification. Must include `"data"` with inline `"values"`, `"mark"` type, and `"encoding"`. Always use `{"data": {"values": [...]}}` for data. |
| `title` | string | no | Chart title used as alt text (default: `"Chart"`). |
| `width` | integer | no | Output width in pixels (default: 800, range: 200–4000). |

### Supported Mark Types

`bar`, `line`, `point`, `area`, `rect`, `circle`, `square`, `arc`, `text`, `tick`, `rule`, `trail`, `boxplot`

Always include `"type"` in encoding channels: `"quantitative"`, `"nominal"`, `"ordinal"`, or `"temporal"`.

### Example

```js
var result = app.integrations.vegalite.render_vegalite({
  spec: String.raw`{
    "$schema": "https://vega.github.io/schema/vega-lite/v5.json",
    "data": {
      "values": [
        {"category": "A", "value": 28},
        {"category": "B", "value": 55},
        {"category": "C", "value": 43}
      ]
    },
    "mark": "bar",
    "encoding": {
      "x": {"field": "category", "type": "nominal"},
      "y": {"field": "value", "type": "quantitative"}
    }
  }`,
  title: "Sample Bar Chart",
  width: 600,
})

console.log(result)
```
