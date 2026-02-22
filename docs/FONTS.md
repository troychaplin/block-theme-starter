# Font Size Configuration

Custom font sizes are defined in `theme.json` under `settings.typography.fontSizes`. These replace the WordPress defaults (`defaultFontSizes: false`) and use WordPress's built-in fluid typography engine (`fluid: true`).

## Font Size Scale

| Name | Slug | Size (max) | Fluid Min | Fluid Max | Fluid? |
|---|---|---|---|---|---|
| Small | `small` | `0.875rem` (14px) | — | — | Auto |
| Medium | `medium` | `1.125rem` (18px) | `1rem` (16px) | `1.125rem` (18px) | Yes |
| Large | `large` | `1.75rem` (28px) | `1.5rem` (24px) | `1.75rem` (28px) | Yes |
| Extra Large | `x-large` | `2.25rem` (36px) | `1.85rem` (29.6px) | `2.25rem` (36px) | Yes |
| Extra Extra Large | `xx-large` | `3.25rem` (52px) | `2.5rem` (40px) | `3.25rem` (52px) | Yes |

## How Fluid Typography Works

When `fluid` is enabled, WordPress generates a `clamp()` function that smoothly scales font sizes between a minimum and maximum viewport width (defaults to 320px and 1600px):

```css
/* Example: Large size output */
font-size: clamp(1.5rem, calc(1.5rem + ((1.75 - 1.5) * ((100vw - 320px) / 1280px))), 1.75rem);
                  ↑                                                                      ↑
                  min (mobile)                                                            max (desktop)
```

- **Below 320px viewport**: font locks at the `min` value
- **320px – 1600px**: font scales smoothly between `min` and `max`
- **Above 1600px**: font locks at the `max` value

## Fluid Range Breakdown

The growth percentage increases with size, so larger headings shrink more aggressively on mobile while body text stays stable.

| Name | Min (px) | Max (px) | Growth | Typical Use |
|---|---|---|---|---|
| Small | 14 | 14 | — | Captions, labels, fine print |
| Medium | 16 | 18 | 12.5% | Body text, paragraphs |
| Large | 24 | 28 | 16.7% | Subheadings (h3, h4) |
| Extra Large | 29.6 | 36 | 21.6% | Section headings (h2) |
| Extra Extra Large | 40 | 52 | 30% | Page titles (h1), hero text |

## Values at Common Breakpoints

Approximate rendered sizes across viewports:

| Name | 375px (Mobile) | 768px (Tablet) | 1280px (Desktop) | 1600px+ |
|---|---|---|---|---|
| Small | 14px | 14px | 14px | 14px |
| Medium | 16.1px | 16.7px | 17.5px | 18px |
| Large | 24.1px | 25.2px | 26.9px | 28px |
| Extra Large | 29.8px | 31.8px | 34.5px | 36px |
| Extra Extra Large | 40.3px | 43.5px | 48.9px | 52px |

## Note on Small Size

Small uses `"fluid": true` without an explicit min/max range. WordPress's fluid engine treats sizes at or below `0.875rem` as effectively static since they're at the minimum fluid threshold. This is intentional — small text should not shrink further on mobile.

## Font Family

The theme uses a system font stack, avoiding external font loading for optimal performance:

```
-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif
```

## Usage in Templates

WordPress generates CSS custom properties for each size:

```css
/* CSS custom property */
font-size: var(--wp--preset--font-size--large);

/* Resolves to the clamp() value */
font-size: clamp(1.5rem, calc(1.5rem + ...), 1.75rem);
```
