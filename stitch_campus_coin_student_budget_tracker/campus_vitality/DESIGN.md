---
name: Campus Vitality
colors:
  surface: '#0b1326'
  surface-dim: '#0b1326'
  surface-bright: '#31394d'
  surface-container-lowest: '#060e20'
  surface-container-low: '#131b2e'
  surface-container: '#171f33'
  surface-container-high: '#222a3d'
  surface-container-highest: '#2d3449'
  on-surface: '#dae2fd'
  on-surface-variant: '#bbcabf'
  inverse-surface: '#dae2fd'
  inverse-on-surface: '#283044'
  outline: '#86948a'
  outline-variant: '#3c4a42'
  surface-tint: '#4edea3'
  primary: '#4edea3'
  on-primary: '#003824'
  primary-container: '#10b981'
  on-primary-container: '#00422b'
  inverse-primary: '#006c49'
  secondary: '#c0c1ff'
  on-secondary: '#1000a9'
  secondary-container: '#3131c0'
  on-secondary-container: '#b0b2ff'
  tertiary: '#ffb95f'
  on-tertiary: '#472a00'
  tertiary-container: '#e29100'
  on-tertiary-container: '#523200'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#6ffbbe'
  primary-fixed-dim: '#4edea3'
  on-primary-fixed: '#002113'
  on-primary-fixed-variant: '#005236'
  secondary-fixed: '#e1e0ff'
  secondary-fixed-dim: '#c0c1ff'
  on-secondary-fixed: '#07006c'
  on-secondary-fixed-variant: '#2f2ebe'
  tertiary-fixed: '#ffddb8'
  tertiary-fixed-dim: '#ffb95f'
  on-tertiary-fixed: '#2a1700'
  on-tertiary-fixed-variant: '#653e00'
  background: '#0b1326'
  on-background: '#dae2fd'
  surface-variant: '#2d3449'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '800'
    lineHeight: 48px
    letterSpacing: -0.03em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 26px
    fontWeight: '700'
    lineHeight: 34px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 30px
    letterSpacing: -0.015em
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 26px
    letterSpacing: -0.01em
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  body-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 18px
  label-lg:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Inter
    fontSize: 10px
    fontWeight: '700'
    lineHeight: 14px
    letterSpacing: 0.04em
  currency-display:
    fontFamily: Plus Jakarta Sans
    fontSize: 36px
    fontWeight: '800'
    lineHeight: 44px
    letterSpacing: -0.03em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  gutter: 1rem
  gutter-tablet: 1.5rem
  gutter-desktop: 2rem
  margin: 1rem
  margin-tablet: 2rem
  margin-desktop: 3rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
---

## Brand & Style

This design system crafts an energetic, empowering, and stress-free financial companion for university students and early-career digital natives. Rather than leaning into intimidating, legacy banking austerity or austere spreadsheets, the visual narrative balances monetary discipline with vibrant campus energy. The aesthetic combines clean modernist layouts with tactile, friendly surfaces—radiating optimism, clarity, and social agility.

The interface pairs modern structural minimalism with soft, luminous depth. High-frequency interactions (such as splitting dinner bills, monitoring campus meal plans, or tracking weekly party budgets) feel as effortless and delightful as dynamic social applications, while retaining institutional clarity, rapid numerical digestion, and clear visual hierarchy.

## Colors

The core color palette communicates vitality, speed, and safety against deep midnight backgrounds:

- **Primary (`#10B981` Emerald Mint):** Represents financial vitality, growth, positive balances, safe spending limits, and confirmation actions. In dark mode, it acts as a luminous anchor with high legibility.
- **Secondary (`#6366F1` Electric Violet):** Powers social interactions, bill splitting, group goals, and recurring allowances. It injects a youthful, tech-forward counterweight to the primary green.
- **Tertiary (`#F59E0B` Warm Amber):** Delivers critical contextual awareness—budget warning thresholds, expiring offers, and pending roommate settlements—without inducing panic.
- **Neutral Canvas (`#0F172A` Deep Midnight Slate):** Provides rich contrast for mobile AMOLED displays, cutting down battery consumption and evening eye fatigue in study environments. Layered surface tiers range from `#0F172A` (base canvas), `#1E293B` (elevated cards), to `#334155` (interactive inputs and segmented track beds).
- **Surface Highlight & Text:** High-contrast off-whites (`#F8FAFC` primary text) and slate mists (`#94A3B8` secondary labels) ensure compliance with WCAG AAA contrast ratios.

## Typography

Typography prioritizes rapid glanceability, numeric legibility, and geometric warmth. 

- **Display & Headings (Plus Jakarta Sans):** Selected for its friendly rounded terminals and geometric authority. It infuses confidence in large account summaries, category breakouts, and milestone achievements without feeling clinical.
- **Body Text (Plus Jakarta Sans):** Carries continuous rhythm through itemized expenses, merchant descriptions, and analytical insights.
- **Labels, Badges, and Micro-data (Inter):** Employs Inter’s systematic neutrality and robust tabular features for transaction timestamps, category tags, split ratios, and secondary telemetry.
- **Financial Numerics:** All currency levels require tabular figures (`tnum`) enabled by default to prevent layout jitter during live balance updates or scrollable transaction ledgers.

## Layout & Spacing

The layout model is anchored in an 8pt spatial grid built around dense mobile thumb-zones and fluid horizontal distribution on larger screens.

- **Mobile First Focus (Breakpoints 0–639px):** Employs a 4-column fluid grid, 16px (`1rem`) outer canvas margins, and 16px gutters. Key operational triggers (quick add, split request, balance switch) remain pinned inside the ergonomic lower 40% thumb reach.
- **Tablet Reflow (640–1023px):** Adapts to an 8-column layout with 24px margins, converting linear feed views into dual-pane dashboard segments (left: accounts & analytics; right: transaction stream & roommate groups).
- **Desktop (1024px+):** Conforms to a 12-column structure with a max-width container capped at 1200px, centering financial charts and operational tables with spacious 32px gutters and margins.
- **Component Flow Spacing:** `space-xs` (4px) isolates micro-tag text from indicator dots; `space-sm` (8px) separates inline metric labels; `space-md` (16px) governs internal card padding and stack margins; `space-lg` (24px) establishes card-to-card breathing room; `space-xl` (32px) marks major screen section breaks.

## Elevation & Depth

Visual hierarchy abandons muddy, harsh black shadows in favor of tinted ambient glow, high-luminance layering, and subtle surface perimeter borders.

- **Base Layer (Ground Zero):** Canvas sits at `#0F172A`. Zero elevation.
- **Tier 1 (Surface Containers & Cards):** Background `#1E293B` elevated with a 1px continuous stroke of `rgba(255, 255, 255, 0.06)` and a subtle ambient shadow: `0 4px 20px -2px rgba(0, 0, 0, 0.35)`.
- **Tier 2 (Floating Action Sheets, Modals, & Active Sliders):** Background `#1E293B` tinted with 4% secondary indigo luminosity. Elevated using a colored ambient shadow: `0 12px 32px -4px rgba(99, 102, 241, 0.15), 0 4px 12px rgba(0, 0, 0, 0.45)`.
- **Tier 3 (Active Overlays & Tooltips):** Background `#334155` with crisp border highlights of `rgba(255, 255, 255, 0.15)`.
- **Luminous Micro-Accents:** Key focal points (such as the primary expense dial or target goal rings) utilize a directional outer radial bloom matching the primary emerald hue (`rgba(16, 185, 129, 0.20)` at 24px blur).

## Shapes

The shape vocabulary uses an organic, tactile aesthetic that softens the rigidity of financial data:

- **Cards & Surfaces:** Configured with `rounded-lg` (16px) for standard budget tiles and transaction clusters, climbing to `rounded-xl` (24px) for hero balance overviews, monthly wrap summaries, and swipeable campus cards.
- **Interactive Controls (Buttons, Form Inputs, Segmented Controls):** Standard controls use `0.75rem` (12px) to match nested card radiuses cleanly.
- **Micro-Badges & Toggle Pills:** Formed with full continuous pill radiuses (`rounded-full` / 9999px) to signal tapability, state segregation, and status immediacy.
- **Nested Ratio Discipline:** Inner nested child elements consistently maintain a radius 4px to 8px smaller than their enclosing container to ensure visual harmony.

## Components

### Buttons
- **Primary Action:** Solid Emerald Mint (`#10B981`) background, bold slate text (`#064E3B`), pill-shaped or 12px border radius. Hover introduces a subtle scale shift (1.02x) and an ambient emerald backlight.
- **Secondary Action:** Translucent Electric Violet (`rgba(99, 102, 241, 0.12)`) fill with high-contrast text (`#818CF8`) and a 1px border of `rgba(99, 102, 241, 0.3)`.
- **Ghost/Tertiary:** No background, `#94A3B8` text, shifting to white text with a soft slate hover plate.
- **Mobile Tap Size:** Minimum vertical hit area is 48px across all variants.

### Cards
- **Budget & Metric Cards:** Built with 16px–24px rounded corners, `#1E293B` container fill, and 1px borders using `rgba(255, 255, 255, 0.07)`. Internal layout incorporates a top-row micro-badge, a central bold metric in `currency-display` sizing, and a bottom edge contextual micro-progress bar.
- **Peer-to-Peer Split Cards:** Feature overlapping 28px circular avatars, an electric violet directional indicator arrow, and tabular settled amounts.

### Micro-Badges & Chips
- **Status Badges:** Full-pill shape with an 8px vertical padding and 12px horizontal padding. Features a live status dot (e.g., `#10B981` pulsing dot for "On Track", `#F59E0B` for "85% Depleted").
- **Category Chips:** Light slate base, selectable with an active border highlight in Electric Violet or Emerald.

### Segmented Pill Toggles
- Used for switching between timeframe views (e.g., "Weekly", "Monthly", "Semester") or account tabs ("Personal", "Roommates").
- Enclosed in an indented `#0F172A` housing with 8px radius or full pill contour. The active tab slides with a physical spring animation onto a `#1E293B` elevated card with crisp white text.

### Inputs & Quick-Add Fields
- Background styled in `#1E293B` with an inset appearance. Inactive border is `rgba(255, 255, 255, 0.1)`. Focus shifts the border to 2px solid `#10B981` with an ambient glow.
- Large numeric keypad inputs (for expense logging) feature centered 36px tabular text with persistent fiat prefix labels.

### Lists & Ledger Rows
- Low-profile horizontal rows separated by hairline dividers (`rgba(255, 255, 255, 0.04)`).
- Left-aligned 40px rounded icon containers holding high-contrast category icons (coffee, textbooks, rent, dining), middle row containing merchant name and subtext timestamp, right-aligned tabular amounts (colored `#10B981` for deposits, `#F8FAFC` for standard expenses).