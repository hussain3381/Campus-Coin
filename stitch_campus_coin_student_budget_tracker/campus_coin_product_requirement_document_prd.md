# Product Requirement Document (PRD) & Product Brief
## **Project:** Campus Coin — Student Budget & Expense Tracker
**Document Version:** 1.0.0  
**Status:** Approved for Implementation  
**Target Audience:** Undergraduate & Graduate College/University Students, Campus Administrators  
**Platforms:** Responsive Web Application (Desktop & Tablet) & Mobile Web / PWA  

---

## 1. Executive Summary & Vision
**Campus Coin** is an AI-enhanced, student-first personal finance and budget management platform. Traditional budgeting apps (Mint, YNAB) fail college students due to rigid corporate paradigms, complex double-entry accounting, and lack of awareness of semester cash-flow patterns (lump-sum financial aid dispatches, intermittent family stipends, meal plan allowances, split dorm utilities, and student-specific micro-transactions).

Campus Coin bridges this gap with:
- **Semester & Term Awareness**: Syncs with academic calendars, midterm stress cycles, and semester goal planning.
- **Micro-Budgeting & Real-Time Impact**: Natural language smart logging with instantaneous feedback on remaining allowance before a purchase is finalized.
- **Student Social Utilities**: Dorm room expense splits, campus vendor recognition, and anonymous peer benchmarking.
- **Dual Visual Modes**: High-contrast Dark Mode (energy-saving, night library study) and crisp Light Mode (daytime campus readability).

---

## 2. Core User Personas

### Persona A: "The Budget-Conscious Frosh" (Alex, 19)
- **Profile:** First-year student living in a dorm on a fixed monthly pocket money allowance ($400/mo) plus campus dining credits.
- **Pain Point:** Overspends on food delivery and social outings in the first two weeks of the month, resulting in late-month stress.
- **Core Need:** Instant feedback before buying, visual warning bars when exceeding 75% of meal allowances, and gamified saving streaks.

### Persona B: "The Working Sophomore" (Ayesha, 20)
- **Profile:** CS major working as a Teaching Assistant ($220/mo) with occasional freelance gigs, managing off-campus apartment rent, transit, and textbook fees.
- **Pain Point:** Erratic income intervals and complicated roommate expense splits.
- **Core Need:** Dual cash flow influx tracking, CSV bulk upload from university credit unions, and verified PDF reports for financial aid clearance.

### Persona C: "The Campus Admin / Financial Aid Advisor"
- **Profile:** University student affairs officer monitoring student emergency funds and financial wellness initiatives.
- **Core Need:** Admin control panel to configure default category caps, broadcast financial aid deadlines, and review aggregate, anonymized student spend stress indices.

---

## 3. Product Architecture & Tech Stack

The system follows a modern **Three-Tier Architecture**:

```
┌─────────────────────────────────────────────────────────────┐
│               PRESENTATION LAYER (Frontend)                 │
│  - React 18+ (TypeScript), Vite, Tailwind CSS 3.4+          │
│  - Lucide Icons, Headless UI, Canvas Confetti               │
│  - Dual Theme Engine (Dark: Campus Vitality / Light)       │
│  - Responsive Viewports: Mobile (390px) & Desktop (1440px) │
└──────────────────────────────┬──────────────────────────────┘
                               │ REST / JSON API (HTTPS)
┌──────────────────────────────▼──────────────────────────────┐
│               APPLICATION LAYER (Laravel Backend)           │
│  - Laravel 11.x (PHP 8.2+), Laravel Sanctum (Auth)         │
│  - Form Requests & Policies (RBAC: Student vs Admin)        │
│  - Queues & Jobs: Async AI categorization & PDF Generation  │
│  - Campus AI Intent Engine (OpenAI / Gemini integration)    │
└──────────────────────────────┬──────────────────────────────┘
                               │ Eloquent ORM
┌──────────────────────────────▼──────────────────────────────┐
│                    DATA LAYER (Storage)                     │
│  - PostgreSQL 15+ / MySQL 8.0+                              │
│  - Redis (Session cache, throttle rate limits, queue jobs) │
│  - S3 / Encrypted Vault (PDF statements, CSV batch logs)   │
└─────────────────────────────────────────────────────────────┘
```

---

## 4. Key Functional Requirements (Modules & Features)

### 4.1 Authentication & Student Profile Setup
- **Multi-Step Onboarding**:
  - Full Name, University `.edu` Email, Password, Academic Year (`Freshman`, `Sophomore`, `Junior`, `Senior`, `Graduate`).
  - Target Stash & Monthly Savings Goal milestone slider (e.g., $350/mo toward "Semester Laptop Fund").
  - Allowance and loan disbursement reminder toggle.
- **Security**: JWT / Sanctum bearer tokens, CSRF protection, password hashing with Argon2id.

### 4.2 Personalized Student Dashboard
- **Header Pacing Bar**: Personalized greeting (*"Salam, Ayesha! 🎓"*), academic calendar indicator (*"Day 18 of 30 • Midterms Week 7"*), and daily financial streak counter.
- **KPI Metrics**:
  - Current Available Balance ($1,240.50).
  - Total Inflow (Monthly pocket money, tutoring stipend, grants).
  - Total Outflow / Burn Rate.
  - Semester Milestone Goal tracker with completion percentage.
- **Budget vs. Actual Progress**: Visual bars indicating category consumption with proactive alert badges (*Approaching Cap*, *Healthy*, *Settled*).
- **Recent Activity Ledger**: Real-time transaction history with merchant tags and category badges.
- **Quick Action Bar**: Shortcuts for `+ Log Expense`, `+ Log Income`, `Split Bill`, and `Scan Receipt`.

### 4.3 Smart Transaction Logging & Bulk Ingestion
- **Expense vs. Income Switcher**: Single tap to switch transactional intent.
- **Keypad & Quick Presets**: Numerical input with dynamic increment chips (`+$5`, `+$10`, `+$20`, `+$50`).
- **Campus AI Intent Engine**:
  - Natural language input bar (e.g., *"Late night Shawarma with Alex $15"*) with auto-entity extraction for merchant, amount, and category (`Food & Dining`).
- **Dynamic Live Budget Impact Banner (Crucial UX)**:
  - As the user types the amount and selects a category, an instant banner calculates the post-transaction budget balance:
    > *"Logging $15.00 for Food & Dining. You will have $45.00 left in your month's food quota ($255/$300). Keep it up! 🎉"*
- **Recurring Transactions**: Toggle switch for recurring monthly payments (Hostel rent, Spotify, Wi-Fi).
- **Bulk Import**: Drag-and-drop CSV/OFX statement parser supporting major campus credit unions and debit accounts, complete with downloadable `.csv` student template.

### 4.4 Category & Allowance Management
- **Category Buckets**:
  - Core categories: `Food & Dining`, `Hostel & Rent`, `Campus Transit`, `Academics & Books`, `Entertainment & Leisure`, `Subscriptions`.
  - Custom category creator: Ability to add student-specific pots (e.g., `Gym & Protein`, `Club Dues`).
- **Threshold Notification Rules**: Granular opt-in triggers (e.g., alert user via push/email when 80% or 90% of cap is depleted).
- **Surplus Rollover**: Unspent allowance rolls over into designated semester goals.

### 4.5 Visual Reports & Analytics
- **Data Visualizations**:
  - **Category Donut Allocation**: Breakdown of monthly expenditure by percentage.
  - **Daily Velocity & Weekend Spikes**: Bar chart highlighting weekday ($23.50/day) vs. weekend leisure spikes ($78/day).
  - **6-Month Cash Flow Influx vs. Outflux**: Dual-bar comparison showing financial aid spikes and burn velocity.
- **Peer Cohort Benchmarking**: Anonymous spending comparisons with respective majors/cohorts (e.g., *"2nd Year CS Students: You spent $40 vs cohort average $85"*).
- **Verified PDF Export**: One-click generation of cryptographic-signed ledger statements (SHA-256) for parents or financial aid offices.

### 4.6 Campus AI Insights Feed
- **Proactive Diagnostics**: Overheat alerts when run rate predicts mid-month depletion.
- **Positive Micro-Wins**: Congratulatory cards when textbook rental saved 45% compared to prior terms.
- **Micro-Savings Coaching**: Automatic round-up simulation (e.g., *"Round up $3.40 canteen coffee to $4.00 to save ~$34/month"*).

### 4.7 Admin Control Panel (System Governance)
- System-wide default category templates for incoming freshman cohorts.
- Campus emergency grant and bursar announcement push broadcast tool.
- Anonymized student wellness metrics (aggregate financial health grade across departments).

---

## 5. Non-Functional & Quality Requirements

| Requirement | Metric / Specification |
|---|---|
| **Performance** | Core Web Vitals LCP < 1.2s; transaction logging DOM response < 50ms. |
| **Accessibility (a11y)** | WCAG 2.1 AA Compliance; minimum 4.5:1 text-to-background contrast ratio in both Light & Dark modes. |
| **Responsiveness** | Fluid breakpoints for Mobile (390px–480px), Tablet (768px–1024px), and Desktop (1280px–1920px). |
| **Security & Privacy** | FERPA-compliant anonymization of cohort benchmarking; AES-256 encryption at rest for bank statements. |
| **Theme Switching** | Seamless zero-flicker CSS variable token swap between Dark (`Campus Vitality`) and Light (`Campus Coin Light`). |

---

## 6. Database Schema Design (Entity Relationship Highlights)

- `users`: `id`, `name`, `email`, `password_hash`, `academic_year`, `college_name`, `monthly_savings_goal`, `created_at`
- `categories`: `id`, `user_id` (null for global defaults), `name`, `icon_slug`, `color_hex`, `monthly_cap`, `alert_threshold_pct`
- `transactions`: `id`, `user_id`, `category_id`, `type` (expense/income), `amount`, `payment_method`, `merchant_name`, `note`, `is_recurring`, `transacted_at`
- `savings_goals`: `id`, `user_id`, `title`, `target_amount`, `saved_amount`, `target_date`, `status`
- `recurring_rules`: `id`, `user_id`, `transaction_id`, `frequency` (monthly/weekly), `next_run_date`, `is_active`

---

## 7. Delivery Roadmap & Milestones

1. **Sprint 1 — Core Auth & Engine**: Laravel Breeze/Sanctum API setup, User Profile, and Database Migration pipeline.
2. **Sprint 2 — Logging Engine & Live Impact**: Transaction API with dynamic budget recalculation endpoint, Smart Logger UI, and CSV parser.
3. **Sprint 3 — Dashboards & Theming**: Desktop & Mobile Responsive Dashboard builds, Light/Dark theme token switchers, and Category Studio.
4. **Sprint 4 — Analytics, AI Insights & Export**: Chart.js / Recharts integration, Cohort benchmark aggregations, PDF statement generator.
5. **Sprint 5 — QA, FERPA Compliance & Launch**: Penetration testing, cross-browser validation, and campus beta rollout.
