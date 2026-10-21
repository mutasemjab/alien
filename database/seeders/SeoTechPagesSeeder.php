<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoTechPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = $this->pages();

        foreach ($pages as $page) {
            $existing = DB::table('blogs')
                ->where('slug', $page['slug'])
                ->orWhere('title_en', $page['title_en'])
                ->first();

            if ($existing) {
                $this->command->line("  skip  {$page['slug']}");
                continue;
            }

            DB::table('blogs')->insert(array_merge($page, [
                'type'         => 'landing_page',
                'status'       => 'active',
                'published_at' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]));

            $this->command->info("  seeded {$page['slug']}");
        }
    }

    private function pages(): array
    {
        return [

            // ── 1. Laravel ─────────────────────────────────────────────────
            [
                'slug'         => 'laravel-development-company-jordan',
                'title_en'     => 'Laravel Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير Laravel في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code is Jordan\'s leading Laravel development company. We build scalable web applications, REST APIs, admin dashboards, and SaaS platforms on Laravel.',
                'excerpt_ar'   => 'Alien Code هي الشركة الرائدة في تطوير Laravel في الأردن. نبني تطبيقات ويب قابلة للتوسع، وواجهات API، ولوحات تحكم، ومنصات SaaS.',
                'meta_title_en'=> 'Laravel Development Company Jordan — Alien Code',
                'meta_title_ar'=> 'شركة تطوير Laravel في الأردن — Alien Code',
                'meta_desc_en' => 'Hire Jordan\'s top Laravel developers. Alien Code delivers Laravel web apps, REST APIs, e-commerce, and SaaS solutions with clean architecture and fast delivery.',
                'meta_desc_ar' => 'وظّف أفضل مطوري Laravel في الأردن. Alien Code تقدم تطبيقات ويب، APIs، وحلول SaaS بمعمارية نظيفة وتسليم سريع.',
                'category_en'  => 'Technology',
                'category_ar'  => 'تقنية',
                'tags'         => json_encode(['Laravel', 'PHP', 'Web Development', 'Jordan', 'REST API']),
                'body_en'      => '<h2>Laravel Development in Jordan</h2>
<p>Laravel is the most popular PHP framework in Jordan and across the Arab world — powering everything from simple business websites to complex enterprise platforms. Alien Code has built dozens of Laravel applications since 2018, making us one of the most experienced Laravel teams in the country.</p>

<h2>What We Build with Laravel</h2>
<ul>
<li><strong>Business Web Applications</strong> — internal tools, CRM systems, workflow automation</li>
<li><strong>REST &amp; GraphQL APIs</strong> — mobile app backends, third-party integrations, microservices</li>
<li><strong>Multi-tenant SaaS Platforms</strong> — subscription billing, role-based access, tenant isolation</li>
<li><strong>E-commerce Storefronts</strong> — custom carts, inventory, order management, Stripe / Jordanian gateways</li>
<li><strong>Admin Dashboards</strong> — Filament, custom Blade UIs, real-time charts</li>
<li><strong>ERP &amp; HR Systems</strong> — payroll, attendance, procurement, Jordan labour law compliance</li>
</ul>

<h2>Our Laravel Tech Stack</h2>
<p>Every project is built on a proven stack: <strong>Laravel 10/11</strong>, <strong>MySQL / PostgreSQL</strong>, <strong>Redis</strong> for queues and caching, <strong>Vue.js or React</strong> for interactive UIs, <strong>Spatie packages</strong> for roles and media, and <strong>Docker</strong> for reproducible deployments. We follow PSR-12 coding standards, write feature tests with PHPUnit and Pest, and ship through CI/CD pipelines on your preferred hosting provider.</p>

<h2>Why Hire a Local Jordan Laravel Team?</h2>
<p>Working with a Jordan-based team means same-timezone communication (AST, GMT+3), Arabic + English bilingual development, understanding of Jordan's regulatory landscape (e-Invoice, SSC, income tax), and the ability to meet face-to-face in Amman when needed. Our hourly rates are 40–60% below equivalent UK or US agencies without sacrificing code quality.</p>

<h2>Laravel Expertise Milestones</h2>
<ul>
<li>50+ Laravel projects delivered in Jordan and the GCC</li>
<li>Average project delivery: 6–14 weeks depending on scope</li>
<li>Longest-running Laravel client relationship: 5+ years</li>
<li>Zero critical production security incidents in our Laravel portfolio</li>
</ul>

<h2>Getting Started</h2>
<p>Share your project brief and we will send a technical proposal and cost estimate within 48 hours. No commitment required.</p>',
                'body_ar'      => '<h2>تطوير Laravel في الأردن</h2>
<p>Laravel هو إطار PHP الأكثر شعبية في الأردن والعالم العربي، ويُشغّل كل شيء من مواقع الأعمال البسيطة إلى المنصات المؤسسية المعقدة. بنت Alien Code عشرات تطبيقات Laravel منذ 2018، مما يجعلنا من أكثر الفرق خبرة في هذا المجال في الأردن.</p>

<h2>ما نبنيه باستخدام Laravel</h2>
<ul>
<li><strong>تطبيقات ويب للأعمال</strong> — أدوات داخلية، أنظمة CRM، أتمتة سير العمل</li>
<li><strong>واجهات API</strong> — خلفيات تطبيقات الجوال، تكاملات مع أطراف ثالثة</li>
<li><strong>منصات SaaS متعددة المستأجرين</strong> — فواتير الاشتراك، صلاحيات الوصول</li>
<li><strong>متاجر إلكترونية</strong> — سلات مخصصة، مخزون، إدارة طلبات، بوابات الأردن</li>
<li><strong>لوحات تحكم إدارية</strong> — Filament، واجهات مخصصة، مخططات بيانية</li>
<li><strong>أنظمة ERP وإدارة الموارد البشرية</strong> — رواتب، حضور، قانون العمل الأردني</li>
</ul>

<h2>مكدس التقنيات لدينا</h2>
<p>كل مشروع يُبنى على مكدس مُثبت: <strong>Laravel 10/11</strong>، <strong>MySQL / PostgreSQL</strong>، <strong>Redis</strong>، <strong>Vue.js أو React</strong>، <strong>Docker</strong>. نلتزم بمعايير PSR-12، نكتب اختبارات وظيفية مع PHPUnit وPest، وننشر من خلال CI/CD.</p>

<h2>لماذا توظيف فريق Laravel محلي في الأردن؟</h2>
<p>العمل مع فريق مقره الأردن يعني التواصل في نفس المنطقة الزمنية، التطوير ثنائي اللغة عربي وإنجليزي، وفهم عميق للبيئة التنظيمية الأردنية. أسعارنا أقل بنسبة 40–60% مقارنة بالوكالات البريطانية أو الأمريكية مع الحفاظ على جودة الكود.</p>',
            ],

            // ── 2. React / Next.js ──────────────────────────────────────────
            [
                'slug'         => 'reactjs-nextjs-development-jordan',
                'title_en'     => 'React & Next.js Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير React و Next.js في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code builds high-performance React and Next.js applications in Jordan — from SEO-optimised marketing sites to complex SaaS dashboards.',
                'excerpt_ar'   => 'تبني Alien Code تطبيقات React و Next.js عالية الأداء في الأردن — من مواقع التسويق المُحسَّنة لمحركات البحث إلى لوحات تحكم SaaS المعقدة.',
                'meta_title_en'=> 'React & Next.js Development Jordan — Alien Code',
                'meta_title_ar'=> 'تطوير React وNext.js في الأردن — Alien Code',
                'meta_desc_en' => 'Top React and Next.js developers in Jordan. Alien Code delivers fast, SEO-friendly web apps with server-side rendering, TypeScript, and headless CMS integration.',
                'meta_desc_ar' => 'أفضل مطوري React وNext.js في الأردن. Alien Code تقدم تطبيقات ويب سريعة ومُحسَّنة لمحركات البحث مع SSR وTypeScript وتكامل CMS.',
                'category_en'  => 'Technology',
                'category_ar'  => 'تقنية',
                'tags'         => json_encode(['React', 'Next.js', 'JavaScript', 'Frontend', 'Jordan']),
                'body_en'      => '<h2>React &amp; Next.js Development in Jordan</h2>
<p>React has become the dominant frontend technology across Jordan\'s tech scene, and Next.js has emerged as the go-to choice for production-grade web applications that need both speed and SEO. Alien Code\'s frontend engineers have shipped React projects since 2019 — ranging from single-page dashboards to full-stack Next.js platforms with thousands of daily users.</p>

<h2>What We Build</h2>
<ul>
<li><strong>Next.js Marketing Sites</strong> — SSR/SSG for lightning-fast pages and top Google rankings</li>
<li><strong>React SPA Dashboards</strong> — analytics panels, admin interfaces, data visualisations</li>
<li><strong>Headless E-commerce</strong> — Next.js storefront + Laravel or Strapi backend</li>
<li><strong>Progressive Web Apps (PWA)</strong> — offline-capable, installable on mobile devices</li>
<li><strong>Real-time Applications</strong> — WebSocket with Laravel Echo or Pusher</li>
<li><strong>Component Libraries</strong> — shared design systems for multi-product companies</li>
</ul>

<h2>Our Frontend Stack</h2>
<p>We work with <strong>React 18 / Next.js 14+</strong>, <strong>TypeScript</strong>, <strong>Tailwind CSS</strong>, <strong>Zustand or Redux Toolkit</strong> for state management, <strong>React Query / SWR</strong> for data fetching, and <strong>Storybook</strong> for component documentation. All new projects target a Lighthouse score of 90+ on mobile.</p>

<h2>Next.js for Jordan SEO</h2>
<p>Jordan-based businesses competing for Arabic and English search terms benefit enormously from Next.js server-side rendering. Static pages load in under 1 second, LCP and CLS Core Web Vitals hit the "Good" threshold, and Google can index every page without JavaScript execution. We also handle Arabic RTL layouts and hreflang tags for bilingual sites.</p>

<h2>Integration Capabilities</h2>
<p>Our React/Next.js apps integrate with Laravel APIs, Strapi, Contentful, Sanity, Shopify Storefront API, Stripe, PayPal, and all major Jordanian payment gateways (eFAWATEERcom, MyFatoorah, Hyperpay).</p>',
                'body_ar'      => '<h2>تطوير React وNext.js في الأردن</h2>
<p>أصبح React التقنية الأمامية السائدة في مشهد التقنية الأردني، وبرز Next.js كخيار أول للتطبيقات الإنتاجية التي تحتاج إلى سرعة وتحسين لمحركات البحث معاً. شحنت مهندسو الواجهة الأمامية في Alien Code مشاريع React منذ 2019.</p>

<h2>ما نبنيه</h2>
<ul>
<li><strong>مواقع تسويقية Next.js</strong> — SSR/SSG لصفحات فائقة السرعة وترتيب عالٍ على Google</li>
<li><strong>لوحات تحكم React SPA</strong> — لوحات تحليلات، واجهات إدارة، تصورات بيانات</li>
<li><strong>تجارة إلكترونية Headless</strong> — واجهة أمامية Next.js + خلفية Laravel أو Strapi</li>
<li><strong>تطبيقات ويب تقدمية (PWA)</strong> — تعمل offline، قابلة للتثبيت على الأجهزة المحمولة</li>
<li><strong>تطبيقات الوقت الحقيقي</strong> — WebSocket مع Laravel Echo أو Pusher</li>
</ul>

<h2>مكدس الواجهة الأمامية</h2>
<p>نعمل مع <strong>React 18 / Next.js 14+</strong>، <strong>TypeScript</strong>، <strong>Tailwind CSS</strong>، <strong>Zustand أو Redux Toolkit</strong>، <strong>React Query / SWR</strong>، و<strong>Storybook</strong>. جميع المشاريع الجديدة تستهدف نتيجة Lighthouse 90+ على الجوال.</p>',
            ],

            // ── 3. Flutter ──────────────────────────────────────────────────
            [
                'slug'         => 'flutter-mobile-app-development-jordan',
                'title_en'     => 'Flutter Mobile App Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير تطبيقات Flutter في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code is Jordan\'s top Flutter app development company. We ship cross-platform iOS and Android apps from a single codebase — faster, cheaper, and better.',
                'excerpt_ar'   => 'Alien Code هي شركة تطوير تطبيقات Flutter الرائدة في الأردن. نطلق تطبيقات iOS وAndroid متقاطعة المنصات من قاعدة كود واحدة.',
                'meta_title_en'=> 'Flutter App Development Jordan — iOS & Android | Alien Code',
                'meta_title_ar'=> 'تطوير تطبيقات Flutter في الأردن — iOS وAndroid | Alien Code',
                'meta_desc_en' => 'Best Flutter developers in Jordan. Alien Code builds beautiful cross-platform iOS & Android apps with Flutter — on-time, on-budget, with Arabic RTL support.',
                'meta_desc_ar' => 'أفضل مطوري Flutter في الأردن. Alien Code تبني تطبيقات iOS وAndroid جميلة متقاطعة المنصات مع دعم RTL العربي.',
                'category_en'  => 'Technology',
                'category_ar'  => 'تقنية',
                'tags'         => json_encode(['Flutter', 'Mobile App', 'iOS', 'Android', 'Jordan']),
                'body_en'      => '<h2>Flutter App Development in Jordan</h2>
<p>Flutter — Google\'s cross-platform UI toolkit — lets us build a single codebase that runs natively on iOS, Android, and the web. For Jordanian businesses, this means cutting app development cost roughly in half compared to building separate native apps, without sacrificing performance or appearance. Alien Code has been Flutter-first since 2020.</p>

<h2>Apps We Build</h2>
<ul>
<li><strong>Customer-facing apps</strong> — delivery, booking, loyalty programs, e-commerce</li>
<li><strong>Employee apps</strong> — field service, attendance, task management, sales force automation</li>
<li><strong>Healthcare apps</strong> — patient portals, appointment scheduling, telemedicine</li>
<li><strong>Education apps</strong> — LMS, quiz platforms, university portals</li>
<li><strong>Fintech apps</strong> — payments, e-wallet, investment tracking (compliant with Jordan CBJ guidelines)</li>
<li><strong>Logistics &amp; Tracking</strong> — real-time GPS, driver apps, dispatch consoles</li>
</ul>

<h2>Full-Stack Flutter + Laravel</h2>
<p>Every Flutter app we deliver comes with a robust backend: <strong>Laravel REST API</strong>, <strong>Firebase</strong> for push notifications, <strong>Stripe or local Jordanian gateways</strong> for payments, and an <strong>admin dashboard</strong> so your team can manage content, users, and orders without writing code.</p>

<h2>Arabic RTL Support</h2>
<p>Flutter\'s layout engine supports right-to-left Arabic natively. We build all our apps with full bilingual support (Arabic + English), proper Arabic typography, and locale-specific formatting for Jordanian currency (JOD) and dates.</p>

<h2>App Store Submission</h2>
<p>We handle everything from icon design and screenshot creation to Google Play and Apple App Store submission, metadata localisation, and post-launch monitoring. Average approval time for our submissions: 2–4 business days.</p>',
                'body_ar'      => '<h2>تطوير تطبيقات Flutter في الأردن</h2>
<p>Flutter — مجموعة أدوات واجهة المستخدم متقاطعة المنصات من Google — تتيح لنا بناء قاعدة كود واحدة تعمل بشكل أصلي على iOS وAndroid والويب. بالنسبة للأعمال الأردنية، هذا يعني تخفيض تكلفة تطوير التطبيقات بنسبة النصف تقريباً مقارنة ببناء تطبيقات أصلية منفصلة. Alien Code تعمل بـFlutter-first منذ 2020.</p>

<h2>التطبيقات التي نبنيها</h2>
<ul>
<li><strong>تطبيقات العملاء</strong> — توصيل، حجز، برامج ولاء، تجارة إلكترونية</li>
<li><strong>تطبيقات الموظفين</strong> — خدمة ميدانية، حضور، إدارة مهام</li>
<li><strong>تطبيقات الرعاية الصحية</strong> — بوابات المرضى، جدولة المواعيد</li>
<li><strong>تطبيقات التعليم</strong> — LMS، منصات اختبارات، بوابات جامعية</li>
<li><strong>تطبيقات الخدمات المالية</strong> — مدفوعات، محفظة إلكترونية (متوافقة مع CBJ)</li>
<li><strong>اللوجستيك والتتبع</strong> — GPS الوقت الحقيقي، تطبيقات السائقين</li>
</ul>

<h2>Flutter كامل + Laravel</h2>
<p>كل تطبيق Flutter نقدمه يأتي مع خلفية قوية: <strong>Laravel REST API</strong>، <strong>Firebase</strong> للإشعارات، <strong>بوابات الدفع الأردنية</strong>، و<strong>لوحة تحكم إدارية</strong> ليتمكن فريقك من إدارة المحتوى والمستخدمين والطلبات.</p>',
            ],

            // ── 4. Python / AI / ML ─────────────────────────────────────────
            [
                'slug'         => 'python-ai-ml-development-jordan',
                'title_en'     => 'Python & AI / Machine Learning Development in Jordan | Alien Code',
                'title_ar'     => 'تطوير Python والذكاء الاصطناعي وتعلم الآلة في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code delivers Python, AI, and machine learning development for Jordan businesses — from data pipelines and NLP chatbots to computer vision and predictive analytics.',
                'excerpt_ar'   => 'تقدم Alien Code تطوير Python والذكاء الاصطناعي للأعمال الأردنية — من تدفقات البيانات وروبوتات المحادثة إلى رؤية الحاسوب والتحليلات التنبؤية.',
                'meta_title_en'=> 'Python AI & Machine Learning Development Jordan | Alien Code',
                'meta_title_ar'=> 'تطوير Python والذكاء الاصطناعي في الأردن | Alien Code',
                'meta_desc_en' => 'Python and AI development company in Jordan. Alien Code builds NLP chatbots, predictive analytics, data pipelines, and computer vision solutions for Jordanian businesses.',
                'meta_desc_ar' => 'شركة تطوير Python والذكاء الاصطناعي في الأردن. Alien Code تبني روبوتات محادثة NLP، وتحليلات تنبؤية، وحلول رؤية الحاسوب.',
                'category_en'  => 'Technology',
                'category_ar'  => 'تقنية',
                'tags'         => json_encode(['Python', 'AI', 'Machine Learning', 'NLP', 'Jordan', 'Data Science']),
                'body_en'      => '<h2>Python &amp; AI Development in Jordan</h2>
<p>Artificial intelligence is no longer exclusive to tech giants. Jordanian companies in retail, healthcare, logistics, and finance are adopting AI to automate workflows, understand customers better, and make smarter decisions. Alien Code\'s Python and AI team helps you identify the right problems to solve and implements production-grade solutions — not just demos.</p>

<h2>AI Services We Offer</h2>
<ul>
<li><strong>NLP &amp; Arabic Chatbots</strong> — GPT-4 / Mistral-powered customer service bots with Arabic dialect understanding</li>
<li><strong>Predictive Analytics</strong> — sales forecasting, churn prediction, demand planning</li>
<li><strong>Computer Vision</strong> — product recognition, defect detection, ID verification, OCR for Arabic documents</li>
<li><strong>Data Pipelines</strong> — ETL, data warehousing, automated reporting with Python + Airflow + dbt</li>
<li><strong>Recommendation Engines</strong> — personalised product suggestions for e-commerce</li>
<li><strong>Document Processing</strong> — automated invoice reading, contract extraction, Arabic OCR</li>
</ul>

<h2>Python Web APIs</h2>
<p>Beyond AI, we build fast Python web services: <strong>FastAPI</strong> for high-throughput REST APIs, <strong>Django</strong> for feature-rich web applications, and <strong>Celery + Redis</strong> for background task queues. We deploy to AWS, Google Cloud, or your on-premise servers.</p>

<h2>Why AI for Jordan Businesses?</h2>
<p>Jordan\'s e-commerce sector is growing at 18% annually. Retail businesses that deploy recommendation engines see 15–30% uplift in average order value. Healthcare clinics that automate scheduling with AI cut no-shows by up to 40%. The ROI is measurable — and Alien Code scopes every AI project with clear KPIs before writing a line of code.</p>',
                'body_ar'      => '<h2>تطوير Python والذكاء الاصطناعي في الأردن</h2>
<p>لم يعد الذكاء الاصطناعي حكراً على عمالقة التقنية. الشركات الأردنية في قطاعات التجزئة والرعاية الصحية واللوجستيك والمالية تتبنى الذكاء الاصطناعي لأتمتة سير العمل وفهم العملاء واتخاذ قرارات أذكى. فريق Python والذكاء الاصطناعي في Alien Code يساعدك على تحديد المشكلات الصحيحة للحل وتنفيذ حلول إنتاجية متكاملة.</p>

<h2>خدمات الذكاء الاصطناعي التي نقدمها</h2>
<ul>
<li><strong>روبوتات المحادثة NLP والعربية</strong> — بوتات خدمة عملاء مدعومة بـGPT-4 مع فهم اللهجة العربية</li>
<li><strong>التحليلات التنبؤية</strong> — توقع المبيعات، التنبؤ بالطلب، منع العملاء من المغادرة</li>
<li><strong>رؤية الحاسوب</strong> — التعرف على المنتجات، كشف العيوب، التحقق من الهوية، OCR للوثائق العربية</li>
<li><strong>تدفقات البيانات</strong> — ETL، مستودعات البيانات، تقارير آلية</li>
<li><strong>محركات التوصيات</strong> — اقتراحات منتجات مخصصة للتجارة الإلكترونية</li>
<li><strong>معالجة المستندات</strong> — قراءة فواتير آلية، استخراج العقود، OCR عربي</li>
</ul>',
            ],

            // ── 5. Node.js / API ────────────────────────────────────────────
            [
                'slug'         => 'nodejs-api-development-jordan',
                'title_en'     => 'Node.js & API Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير Node.js وواجهات API في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code builds high-performance Node.js backends and REST/GraphQL APIs for Jordanian startups and enterprises — real-time, scalable, and production-ready.',
                'excerpt_ar'   => 'تبني Alien Code خلفيات Node.js عالية الأداء وواجهات REST/GraphQL API للشركات الناشئة والمؤسسات الأردنية — في الوقت الحقيقي وقابلة للتوسع.',
                'meta_title_en'=> 'Node.js & API Development Jordan | Alien Code',
                'meta_title_ar'=> 'تطوير Node.js وAPI في الأردن | Alien Code',
                'meta_desc_en' => 'Node.js API development company in Jordan. Alien Code delivers Express/Fastify REST APIs, GraphQL services, WebSocket real-time systems, and microservices architecture.',
                'meta_desc_ar' => 'شركة تطوير Node.js وAPI في الأردن. Alien Code تقدم REST APIs، خدمات GraphQL، أنظمة WebSocket، ومعمارية الخدمات المصغرة.',
                'category_en'  => 'Technology',
                'category_ar'  => 'تقنية',
                'tags'         => json_encode(['Node.js', 'API', 'JavaScript', 'GraphQL', 'Jordan', 'Backend']),
                'body_en'      => '<h2>Node.js &amp; API Development in Jordan</h2>
<p>Node.js is the engine behind many of Jordan\'s fastest-growing apps. Its non-blocking I/O model handles thousands of simultaneous connections — ideal for real-time features like live tracking, chat, notifications, and streaming dashboards. Alien Code\'s backend engineers have been building production Node.js services since 2017.</p>

<h2>What We Build</h2>
<ul>
<li><strong>REST APIs</strong> — Express.js / Fastify backends for mobile apps and web frontends</li>
<li><strong>GraphQL APIs</strong> — flexible query layer for complex data relationships</li>
<li><strong>Real-time Services</strong> — Socket.IO chat, live tracking, event streaming</li>
<li><strong>Microservices</strong> — decoupled services with RabbitMQ or Kafka message brokers</li>
<li><strong>Serverless Functions</strong> — AWS Lambda, Vercel edge functions for lightweight operations</li>
<li><strong>BFF (Backend for Frontend)</strong> — API gateway layer tailored for specific client apps</li>
</ul>

<h2>Our Node.js Stack</h2>
<p>We use <strong>Node.js 20 LTS</strong>, <strong>Express.js or Fastify</strong>, <strong>TypeScript</strong>, <strong>Prisma ORM</strong> (with PostgreSQL), <strong>Redis</strong> for caching and sessions, <strong>Bull</strong> for job queues, and <strong>Jest</strong> for unit/integration tests. APIs are documented with <strong>OpenAPI / Swagger</strong>.</p>

<h2>API Integration Expertise</h2>
<p>Beyond building APIs, we integrate with payment gateways (Stripe, eFAWATEERcom, Hyperpay), telecom OTP services (Zain, Orange, Umniah), shipping providers (Aramex, DHL Jordan), government systems (e-Invoice Jordan), and popular third-party platforms (WhatsApp Business API, Salesforce, SAP).</p>

<h2>Performance at Scale</h2>
<p>Our Node.js APIs routinely handle 1,000+ requests per second under load. We instrument every service with <strong>Prometheus + Grafana</strong>, set up alerts for p99 latency and error rates, and provide full runbooks for your operations team.</p>',
                'body_ar'      => '<h2>تطوير Node.js وAPI في الأردن</h2>
<p>Node.js هو المحرك وراء كثير من أسرع التطبيقات نمواً في الأردن. نموذج I/O غير المحجوب يتعامل مع آلاف الاتصالات المتزامنة — مثالي لميزات الوقت الحقيقي مثل التتبع المباشر والدردشة والإشعارات. مهندسو الخلفية في Alien Code يبنون خدمات Node.js الإنتاجية منذ 2017.</p>

<h2>ما نبنيه</h2>
<ul>
<li><strong>REST APIs</strong> — خلفيات Express.js / Fastify لتطبيقات الجوال والواجهات الأمامية</li>
<li><strong>GraphQL APIs</strong> — طبقة استعلام مرنة للعلاقات المعقدة بين البيانات</li>
<li><strong>خدمات الوقت الحقيقي</strong> — Socket.IO للدردشة، التتبع المباشر، بث الأحداث</li>
<li><strong>الخدمات المصغرة</strong> — خدمات مفصولة مع RabbitMQ أو Kafka</li>
<li><strong>الوظائف بدون خادم</strong> — AWS Lambda، Vercel edge functions</li>
</ul>

<h2>مكدس Node.js لدينا</h2>
<p>نستخدم <strong>Node.js 20 LTS</strong>، <strong>Express.js أو Fastify</strong>، <strong>TypeScript</strong>، <strong>Prisma ORM</strong>، <strong>Redis</strong>، <strong>Bull</strong> لقوائم الوظائف، و<strong>Jest</strong> للاختبارات. توثيق APIs بـ<strong>OpenAPI / Swagger</strong>.</p>',
            ],
        ];
    }
}
