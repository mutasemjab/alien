<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoIndustriesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = $this->pages();

        DB::transaction(function () use ($pages) {
            $created = $updated = $skipped = 0;

            foreach ($pages as $page) {
                if (Blog::where('slug', $page['slug'])->exists()) {
                    $this->command->line("  skip (slug exists): {$page['slug']}");
                    $skipped++;
                    continue;
                }
                if (Blog::where('title_en', $page['title_en'])->exists()) {
                    $this->command->line("  skip (title exists): {$page['title_en']}");
                    $skipped++;
                    continue;
                }

                Blog::create(array_merge($page, [
                    'type'         => 'landing_page',
                    'is_active'    => true,
                    'published_at' => now()->subDays(rand(2, 30)),
                    'author'       => 'Alien Code',
                ]));
                $this->command->info("  created: {$page['slug']}");
                $created++;
            }

            $this->command->info("SeoIndustriesSeeder: {$created} created | {$updated} updated | {$skipped} skipped");
        });
    }

    private function pages(): array
    {
        return [

            // ── 1. Hospital / Clinic Software ────────────────────────────────
            [
                'slug'         => 'hospital-clinic-software-jordan',
                'title_en'     => 'Hospital & Clinic Management Software in Jordan',
                'title_ar'     => 'نظام إدارة المستشفيات والعيادات في الأردن',
                'excerpt_en'   => 'Custom hospital and clinic management software for Jordanian healthcare providers — patient records, appointments, billing, pharmacy, and more.',
                'excerpt_ar'   => 'نظام إدارة مستشفيات وعيادات مخصص لمقدمي الرعاية الصحية في الأردن — سجلات المرضى والمواعيد والفواتير والصيدلية والمزيد.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Healthcare', 'EMR', 'Hospital', 'Clinic', 'Jordan'],
                'meta_title_en'=> 'Hospital & Clinic Management Software Jordan | Alien Code',
                'meta_title_ar'=> 'نظام إدارة مستشفيات وعيادات في الأردن | Alien Code',
                'meta_desc_en' => 'Custom hospital management software for Jordan — EMR, appointment scheduling, pharmacy, billing, and insurance integration built by Alien Code.',
                'meta_desc_ar' => 'نظام إدارة مستشفيات مخصص للأردن — سجلات طبية إلكترونية وجدولة المواعيد والصيدلية والفواتير وتكامل التأمين من Alien Code.',
                'sort_order'   => 50,
                'body_en'      => '<h2>The Challenge of Managing Healthcare in Jordan</h2>
<p>Jordan has over 5,000 private clinics and more than 100 hospitals. Most still rely on paper records, WhatsApp appointment booking, and spreadsheet billing — systems that break under the pressure of growing patient volumes, multi-branch operations, and insurance requirements. A purpose-built system changes everything.</p>

<h2>What Our Healthcare Software Includes</h2>
<ul>
<li><strong>Electronic Medical Records (EMR)</strong> — Complete patient history, diagnoses, prescriptions, and lab results accessible across branches.</li>
<li><strong>Appointment Scheduling</strong> — Online and walk-in booking, doctor availability calendars, SMS/WhatsApp reminders to reduce no-shows.</li>
<li><strong>Billing & Insurance</strong> — Automated invoice generation, insurance claim submission, and payment tracking.</li>
<li><strong>Pharmacy Management</strong> — Drug inventory, dispensing records, interaction alerts, and expiry tracking.</li>
<li><strong>Laboratory Module</strong> — Lab order management, result entry, and patient result delivery via portal or SMS.</li>
<li><strong>Multi-Branch Management</strong> — Centralized patient records shared across all locations.</li>
<li><strong>Doctor & Staff Portal</strong> — Shift scheduling, performance metrics, and payroll integration.</li>
</ul>

<h2>Why Jordanian Healthcare Providers Choose Alien Code</h2>
<p>We have deployed healthcare systems for private clinics, polyclinics, and specialized centers across Jordan. Our systems are built in Arabic and English, comply with Jordan\'s Ministry of Health data regulations, and integrate with the local health insurance ecosystem.</p>

<h2>Technology Stack</h2>
<p>We build on Laravel (backend), React (web portal), and Flutter (mobile patient app). All data is encrypted at rest and in transit. Systems can be hosted on private servers or secure cloud infrastructure.</p>',

                'body_ar'      => '<h2>تحدي إدارة الرعاية الصحية في الأردن</h2>
<p>يضم الأردن أكثر من 5,000 عيادة خاصة وما يزيد على 100 مستشفى. معظمها لا تزال تعتمد على السجلات الورقية وحجز المواعيد عبر واتساب وجداول بيانات الفواتير — أنظمة تنهار تحت ضغط تزايد أعداد المرضى والعمليات متعددة الفروع ومتطلبات التأمين. النظام المبني لأغراض محددة يغير كل شيء.</p>

<h2>ما يتضمنه نظامنا للرعاية الصحية</h2>
<ul>
<li><strong>السجلات الطبية الإلكترونية (EMR)</strong> — سجل المريض الكامل والتشخيصات والوصفات ونتائج المختبر في متناول يدك عبر الفروع.</li>
<li><strong>جدولة المواعيد</strong> — حجز إلكتروني وللزوار الحاليين وتقويمات إتاحة الأطباء وتذكيرات عبر SMS/واتساب لتقليل الغياب.</li>
<li><strong>الفواتير والتأمين</strong> — إنشاء فواتير آلي وتقديم مطالبات التأمين وتتبع المدفوعات.</li>
<li><strong>إدارة الصيدلية</strong> — مخزون الأدوية وسجلات الصرف وتنبيهات التفاعل الدوائي وتتبع انتهاء الصلاحية.</li>
<li><strong>وحدة المختبر</strong> — إدارة أوامر المختبر وإدخال النتائج وتسليمها للمرضى عبر البوابة أو SMS.</li>
<li><strong>إدارة متعددة الفروع</strong> — سجلات مرضى مركزية مشتركة عبر جميع المواقع.</li>
<li><strong>بوابة الأطباء والموظفين</strong> — جدولة الشيفتات ومقاييس الأداء وتكامل الرواتب.</li>
</ul>

<h2>لماذا يختار مقدمو الرعاية الصحية الأردنيون Alien Code؟</h2>
<p>طورنا أنظمة رعاية صحية للعيادات الخاصة والمستوصفات والمراكز المتخصصة في أنحاء الأردن. أنظمتنا مبنية باللغتين العربية والإنجليزية وتمتثل للوائح وزارة الصحة الأردنية وتتكامل مع بيئة التأمين الصحي المحلية.</p>',
            ],

            // ── 2. Restaurant / POS Software ────────────────────────────────
            [
                'slug'         => 'restaurant-pos-software-jordan',
                'title_en'     => 'Restaurant Management & POS Software in Jordan',
                'title_ar'     => 'نظام إدارة المطاعم ونقطة البيع في الأردن',
                'excerpt_en'   => 'Complete restaurant and café management software for Jordan — POS, kitchen display, delivery integration, inventory, and staff scheduling.',
                'excerpt_ar'   => 'نظام إدارة مطاعم ومقاهٍ متكامل للأردن — نقطة البيع وشاشة المطبخ وتكامل التوصيل والمخزون وجدولة الموظفين.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Restaurant', 'POS', 'F&B', 'Delivery', 'Jordan'],
                'meta_title_en'=> 'Restaurant POS & Management Software Jordan | Alien Code',
                'meta_title_ar'=> 'نظام إدارة المطاعم ونقطة البيع الأردن | Alien Code',
                'meta_desc_en' => 'Restaurant POS, kitchen display, and delivery management software built for Jordan\'s F&B industry by Alien Code.',
                'meta_desc_ar' => 'نظام نقطة بيع وشاشة مطبخ وإدارة توصيل مبني لقطاع المطاعم الأردني من Alien Code.',
                'sort_order'   => 51,
                'body_en'      => '<h2>Jordan\'s Restaurant Industry Deserves Better Software</h2>
<p>With over 15,000 food and beverage establishments in Jordan and the rise of delivery platforms like Talabat and Carriage, restaurant operators face unprecedented operational complexity. Off-the-shelf POS systems from abroad often lack Arabic support, local tax configuration, and integration with regional delivery apps.</p>

<h2>Our Restaurant Software Features</h2>
<ul>
<li><strong>Touch-Screen POS</strong> — Fast order entry for dine-in, takeaway, and delivery with table management and split-bill support.</li>
<li><strong>Kitchen Display System (KDS)</strong> — Real-time order routing to kitchen stations with preparation time tracking.</li>
<li><strong>Delivery Integration</strong> — Direct integration with Talabat, Carriage, and your own delivery fleet.</li>
<li><strong>Inventory & Recipe Management</strong> — Ingredient-level costing, stock alerts, and waste tracking.</li>
<li><strong>Staff Scheduling & Payroll</strong> — Shift planning, attendance tracking, and hourly wage calculation.</li>
<li><strong>Loyalty & CRM</strong> — Customer loyalty points, birthday offers, and SMS/WhatsApp marketing campaigns.</li>
<li><strong>Reporting Dashboard</strong> — Daily sales, top-selling items, hourly traffic analysis, and profitability per table.</li>
</ul>

<h2>Multi-Branch Restaurant Chains</h2>
<p>We build central management dashboards for restaurant chains across Jordan that give owners real-time visibility into every branch\'s sales, inventory, and staff — from a single screen.</p>',

                'body_ar'      => '<h2>قطاع المطاعم الأردني يستحق برمجيات أفضل</h2>
<p>مع وجود أكثر من 15,000 منشأة طعام وشراب في الأردن وصعود منصات التوصيل مثل طلبات وكاريدج، يواجه أصحاب المطاعم تعقيداً تشغيلياً غير مسبوق. أنظمة نقطة البيع الجاهزة الأجنبية غالباً ما تفتقر إلى دعم اللغة العربية وإعداد الضريبة المحلية والتكامل مع تطبيقات التوصيل الإقليمية.</p>

<h2>مميزات نظام المطاعم لدينا</h2>
<ul>
<li><strong>نقطة بيع بشاشة لمس</strong> — إدخال طلبات سريع للجلوس والطعام المنزلي والتوصيل مع إدارة الطاولات ودعم تقسيم الفاتورة.</li>
<li><strong>شاشة عرض المطبخ (KDS)</strong> — توجيه الطلبات في الوقت الفعلي لمحطات المطبخ مع تتبع وقت التحضير.</li>
<li><strong>تكامل التوصيل</strong> — تكامل مباشر مع طلبات وكاريدج وأسطول التوصيل الخاص بك.</li>
<li><strong>إدارة المخزون والوصفات</strong> — تكاليف على مستوى المكونات وتنبيهات المخزون وتتبع الهدر.</li>
<li><strong>جدولة الموظفين والرواتب</strong> — تخطيط الشيفتات وتتبع الحضور وحساب الأجر بالساعة.</li>
<li><strong>الولاء وإدارة علاقات العملاء</strong> — نقاط ولاء العملاء وعروض أعياد الميلاد وحملات تسويقية عبر SMS/واتساب.</li>
<li><strong>لوحة إدارة التقارير</strong> — مبيعات يومية وأكثر الأصناف مبيعاً وتحليل حركة المرور بالساعة والربحية لكل طاولة.</li>
</ul>',
            ],

            // ── 3. School / Education Software ──────────────────────────────
            [
                'slug'         => 'school-management-software-jordan',
                'title_en'     => 'School & University Management Software in Jordan',
                'title_ar'     => 'نظام إدارة المدارس والجامعات في الأردن',
                'excerpt_en'   => 'Custom school management systems for Jordanian private schools and universities — student portals, attendance, grades, and parent communication.',
                'excerpt_ar'   => 'أنظمة إدارة مدارس مخصصة للمدارس الخاصة والجامعات الأردنية — بوابات الطلاب والحضور والدرجات وتواصل الأهل.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Education', 'School', 'LMS', 'EdTech', 'Jordan'],
                'meta_title_en'=> 'School Management Software Jordan — LMS & Student Portal | Alien Code',
                'meta_title_ar'=> 'نظام إدارة المدارس الأردن — LMS وبوابة الطلاب | Alien Code',
                'meta_desc_en' => 'Custom school and university management systems for Jordan — attendance, grades, LMS, parent portal, and fee management by Alien Code.',
                'meta_desc_ar' => 'أنظمة إدارة مدارس وجامعات مخصصة للأردن — الحضور والدرجات وLMS وبوابة الأهل وإدارة الرسوم من Alien Code.',
                'sort_order'   => 52,
                'body_en'      => '<h2>Digital Transformation for Jordan\'s Schools</h2>
<p>Jordan has over 6,000 schools and 30+ universities, many of which still manage student records, fee collection, and parent communication through disconnected tools. A unified school management system reduces administrative overhead, improves parent engagement, and enables data-driven decisions on student performance.</p>

<h2>What Our School Software Covers</h2>
<ul>
<li><strong>Student Information System (SIS)</strong> — Enrollment, profiles, academic history, and document management.</li>
<li><strong>Attendance Tracking</strong> — RFID card or QR-based check-in with instant SMS alerts to parents for absences.</li>
<li><strong>Grades & Report Cards</strong> — Teachers enter marks online; report cards generate automatically.</li>
<li><strong>Learning Management System (LMS)</strong> — Course content delivery, assignments, quizzes, and video lessons.</li>
<li><strong>Fee Management & Online Payment</strong> — Tuition fee schedules, installment plans, and payment gateway integration.</li>
<li><strong>Parent Mobile App</strong> — Grades, attendance, homework, and school announcements — all in one app.</li>
<li><strong>Library Management</strong> — Book catalog, borrowing history, and overdue notifications.</li>
</ul>

<h2>Arabic-First Design</h2>
<p>All our school systems are fully bilingual (Arabic/English) and right-to-left ready. We understand the specific curriculum formats, grading systems, and Ministry of Education reporting requirements used in Jordan.</p>',

                'body_ar'      => '<h2>التحول الرقمي لمدارس الأردن</h2>
<p>يضم الأردن أكثر من 6,000 مدرسة وأكثر من 30 جامعة، كثيرٌ منها لا تزال تدير سجلات الطلاب وتحصيل الرسوم وتواصل الأهل عبر أدوات متشتتة. نظام إدارة مدرسية موحد يقلل العبء الإداري ويحسن مشاركة الأهل ويمكّن اتخاذ قرارات مستندة إلى البيانات حول أداء الطلاب.</p>

<h2>ما يغطيه نظامنا المدرسي</h2>
<ul>
<li><strong>نظام معلومات الطلاب (SIS)</strong> — التسجيل والملفات الشخصية والسجل الأكاديمي وإدارة الوثائق.</li>
<li><strong>تتبع الحضور</strong> — تسجيل دخول بكارت RFID أو QR مع تنبيهات SMS فورية للأهل عند الغياب.</li>
<li><strong>الدرجات وبطاقات التقرير</strong> — يدخل المعلمون العلامات إلكترونياً وتُنشأ بطاقات التقرير تلقائياً.</li>
<li><strong>نظام إدارة التعلم (LMS)</strong> — تقديم محتوى الدروس والواجبات والاختبارات والدروس المصورة.</li>
<li><strong>إدارة الرسوم والدفع الإلكتروني</strong> — جداول رسوم الدراسة وخطط التقسيط وتكامل بوابة الدفع.</li>
<li><strong>تطبيق جوال للأهل</strong> — الدرجات والحضور والواجبات وإعلانات المدرسة — كل شيء في تطبيق واحد.</li>
<li><strong>إدارة المكتبة</strong> — كتالوج الكتب وسجل الاستعارة وتنبيهات التأخير.</li>
</ul>',
            ],

            // ── 4. Real Estate Software ──────────────────────────────────────
            [
                'slug'         => 'real-estate-software-jordan',
                'title_en'     => 'Real Estate Management Software in Jordan',
                'title_ar'     => 'نظام إدارة العقارات في الأردن',
                'excerpt_en'   => 'Property listing, CRM, and rental management software for Jordan\'s real estate companies and property developers.',
                'excerpt_ar'   => 'نظام إدارة قوائم العقارات وإدارة علاقات العملاء وإدارة الإيجار لشركات العقارات ومطوري العقارات في الأردن.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Real Estate', 'Property', 'CRM', 'Jordan', 'Rental'],
                'meta_title_en'=> 'Real Estate Software Jordan — Property & Rental Management | Alien Code',
                'meta_title_ar'=> 'نظام إدارة العقارات الأردن — إدارة الممتلكات والإيجار | Alien Code',
                'meta_desc_en' => 'Custom real estate software for Jordan — property listings, CRM, lease management, and rental collection built by Alien Code.',
                'meta_desc_ar' => 'برمجيات عقارية مخصصة للأردن — قوائم العقارات وإدارة علاقات العملاء وإدارة الإيجار وتحصيل الأقساط من Alien Code.',
                'sort_order'   => 53,
                'body_en'      => '<h2>Jordan\'s Real Estate Market Needs Modern Software</h2>
<p>Jordan\'s real estate sector is one of the most active in the region, with high transaction volumes in Amman, Zarqa, and Aqaba. Yet most agencies still use Excel, WhatsApp, and paper contracts. A dedicated real estate platform improves lead management, tenant experience, and owner reporting dramatically.</p>

<h2>What Our Real Estate Software Does</h2>
<ul>
<li><strong>Property Listings CMS</strong> — Upload and manage apartments, villas, and commercial units with photos, floor plans, and virtual tours.</li>
<li><strong>Lead CRM</strong> — Track every buyer and tenant inquiry, assign to agents, and manage follow-up pipelines.</li>
<li><strong>Contract & Lease Management</strong> — Digital contracts, renewal reminders, and legal document storage.</li>
<li><strong>Rental Payment Tracking</strong> — Automated rent due reminders, payment recording, and late-fee calculation.</li>
<li><strong>Owner Portal</strong> — Property owners log in to see rent collections, maintenance requests, and occupancy rates.</li>
<li><strong>Maintenance Ticketing</strong> — Tenants submit maintenance requests; property managers assign and track them.</li>
<li><strong>Commission Management</strong> — Track agent commissions per deal with automated payout calculations.</li>
</ul>

<h2>Arabic Contracts & Jordanian Law Compliance</h2>
<p>We generate lease and sale contracts that comply with Jordan\'s real estate regulations, with full Arabic/English bilingual support.</p>',

                'body_ar'      => '<h2>سوق العقارات الأردني يحتاج برمجيات حديثة</h2>
<p>قطاع العقارات الأردني هو من أكثر القطاعات نشاطاً في المنطقة، مع حجم معاملات مرتفع في عمّان والزرقاء والعقبة. ومع ذلك لا تزال معظم الشركات تستخدم Excel وواتساب والعقود الورقية. منصة عقارية مخصصة تحسن إدارة العملاء المحتملين وتجربة المستأجر وتقارير المالك بشكل كبير.</p>

<h2>ما يفعله نظامنا العقاري</h2>
<ul>
<li><strong>نظام إدارة قوائم العقارات</strong> — رفع وإدارة الشقق والفيلات والوحدات التجارية مع الصور ومخططات الطوابق والجولات الافتراضية.</li>
<li><strong>إدارة علاقات العملاء المحتملين</strong> — تتبع كل استفسار من مشترٍ أو مستأجر وإسناده للوكلاء وإدارة مسارات المتابعة.</li>
<li><strong>إدارة العقود والإيجار</strong> — عقود رقمية وتذكيرات التجديد وتخزين الوثائق القانونية.</li>
<li><strong>تتبع مدفوعات الإيجار</strong> — تذكيرات استحقاق الإيجار الآلية وتسجيل المدفوعات وحساب رسوم التأخير.</li>
<li><strong>بوابة الملاك</strong> — يسجل أصحاب العقارات دخولهم لرؤية تحصيل الإيجارات وطلبات الصيانة ومعدلات الإشغال.</li>
<li><strong>تذاكر الصيانة</strong> — يقدم المستأجرون طلبات الصيانة ويسندها ويتابعها مديرو العقارات.</li>
</ul>',
            ],

            // ── 5. Retail / POS / Inventory ──────────────────────────────────
            [
                'slug'         => 'retail-pos-inventory-jordan',
                'title_en'     => 'Retail POS & Inventory Management Software in Jordan',
                'title_ar'     => 'نظام نقطة بيع وإدارة مخزون التجزئة في الأردن',
                'excerpt_en'   => 'POS, inventory, and multi-branch retail management software tailored for Jordan\'s supermarkets, pharmacies, and retail chains.',
                'excerpt_ar'   => 'نظام نقطة بيع وإدارة مخزون وفروع متعددة للتجزئة مخصص لسوبرماركتات الأردن والصيدليات وسلاسل التجزئة.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Retail', 'POS', 'Inventory', 'Supermarket', 'Jordan'],
                'meta_title_en'=> 'Retail POS & Inventory Software Jordan | Alien Code',
                'meta_title_ar'=> 'نظام نقطة بيع وإدارة مخزون التجزئة الأردن | Alien Code',
                'meta_desc_en' => 'Custom POS and inventory management for Jordan\'s retailers — barcode, multi-branch, supplier management, and financial reporting.',
                'meta_desc_ar' => 'نظام نقطة بيع وإدارة مخزون مخصص لتجار التجزئة في الأردن — باركود وفروع متعددة وإدارة الموردين والتقارير المالية.',
                'sort_order'   => 54,
                'body_en'      => '<h2>Jordan\'s Retail Sector Is Growing Fast</h2>
<p>From Amman\'s hypermarkets to neighbourhood pharmacies and specialty stores in Zarqa and Irbid, Jordan\'s retail landscape is diverse and competitive. Managing inventory across multiple branches, handling barcode scanning, applying promotional pricing, and integrating with accounting software — these are daily operational challenges that a well-built retail system solves.</p>

<h2>Our Retail Software Features</h2>
<ul>
<li><strong>Touchscreen POS</strong> — Fast sales processing with barcode scanner, cash, card, and e-wallet support.</li>
<li><strong>Inventory Management</strong> — Real-time stock levels, low-stock alerts, automatic reorder points, and batch/expiry tracking.</li>
<li><strong>Multi-Branch Control</strong> — Central inventory visibility across all branches with inter-branch transfer management.</li>
<li><strong>Supplier & Purchase Orders</strong> — Raise purchase orders, receive goods, and reconcile supplier invoices.</li>
<li><strong>Promotions Engine</strong> — Bundle deals, percentage discounts, BOGO offers, and loyalty card integration.</li>
<li><strong>Customer Accounts & Credit</strong> — Credit limits, customer balances, and account statements for wholesale clients.</li>
<li><strong>Financial Reports</strong> — Daily Z-report, profit margins per SKU, and tax-ready GST reports.</li>
</ul>',

                'body_ar'      => '<h2>قطاع التجزئة الأردني ينمو بسرعة</h2>
<p>من الهايبرماركتات في عمّان إلى الصيدليات المحلية والمتاجر المتخصصة في الزرقاء وإربد، يتسم مشهد التجزئة الأردني بالتنوع والتنافسية. إدارة المخزون عبر فروع متعددة ومعالجة قراءة الباركود وتطبيق أسعار ترويجية وتكاملها مع برامج المحاسبة — هذه تحديات تشغيلية يومية يحلها النظام المبني جيداً.</p>

<h2>مميزات نظامنا لتجارة التجزئة</h2>
<ul>
<li><strong>نقطة بيع بشاشة لمس</strong> — معالجة مبيعات سريعة مع قارئ باركود ودعم النقد والبطاقة والمحافظ الإلكترونية.</li>
<li><strong>إدارة المخزون</strong> — مستويات المخزون في الوقت الفعلي وتنبيهات انخفاض المخزون ونقاط إعادة الطلب التلقائية وتتبع الدُفعات/انتهاء الصلاحية.</li>
<li><strong>التحكم في الفروع المتعددة</strong> — رؤية مركزية للمخزون عبر جميع الفروع مع إدارة التحويل بين الفروع.</li>
<li><strong>الموردون وأوامر الشراء</strong> — إنشاء أوامر الشراء واستلام البضائع ومطابقة فواتير الموردين.</li>
<li><strong>محرك العروض الترويجية</strong> — عروض الباقات وخصومات النسبة المئوية وعروض اشترِ واحدة واحصل على واحدة وتكامل بطاقة الولاء.</li>
<li><strong>حسابات العملاء والائتمان</strong> — حدود الائتمان وأرصدة العملاء وكشوف الحسابات لعملاء الجملة.</li>
</ul>',
            ],

            // ── 6. Logistics / Transportation ────────────────────────────────
            [
                'slug'         => 'logistics-transport-software-jordan',
                'title_en'     => 'Logistics & Transportation Management Software in Jordan',
                'title_ar'     => 'نظام إدارة الشحن واللوجستيات في الأردن',
                'excerpt_en'   => 'Fleet management, route optimization, and logistics software for Jordan\'s shipping companies, freight forwarders, and delivery businesses.',
                'excerpt_ar'   => 'إدارة الأسطول وتحسين المسارات وبرمجيات اللوجستيات لشركات الشحن والتخليص الجمركي وخدمات التوصيل في الأردن.',
                'category_en'  => 'Industry Software',
                'category_ar'  => 'برمجيات القطاعات',
                'tags'         => ['Logistics', 'Fleet', 'Shipping', 'Transport', 'Jordan'],
                'meta_title_en'=> 'Logistics & Fleet Management Software Jordan | Alien Code',
                'meta_title_ar'=> 'نظام إدارة الشحن والأسطول في الأردن | Alien Code',
                'meta_desc_en' => 'Custom logistics and fleet management software for Jordan — route optimization, driver apps, cargo tracking, and customs documentation.',
                'meta_desc_ar' => 'برمجيات لوجستيات وإدارة أسطول مخصصة للأردن — تحسين المسارات وتطبيقات السائقين وتتبع البضائع ووثائق الجمارك.',
                'sort_order'   => 55,
                'body_en'      => '<h2>Jordan: A Regional Logistics Hub</h2>
<p>Positioned at the crossroads of the Middle East, Jordan processes billions of dollars in trade every year through Aqaba Port and its land border crossings with Saudi Arabia, Iraq, and Syria. Logistics companies operating in this environment need systems that handle multi-modal freight, customs documentation, live driver tracking, and customer self-service portals.</p>

<h2>Our Logistics Software Features</h2>
<ul>
<li><strong>Fleet Management</strong> — Vehicle maintenance schedules, fuel consumption tracking, and GPS integration.</li>
<li><strong>Driver Mobile App</strong> — Drivers receive delivery assignments, capture proof-of-delivery photos, and update status in real time.</li>
<li><strong>Route Optimization</strong> — AI-powered routing to minimize fuel cost and delivery time across Jordan\'s road network.</li>
<li><strong>Cargo & Shipment Tracking</strong> — QR/barcode-based cargo tracking with customer SMS updates.</li>
<li><strong>Customs & Clearance Documentation</strong> — Generate packing lists, certificates of origin, and customs declarations compliant with Aqaba and border crossings.</li>
<li><strong>Warehouse Management</strong> — Dock scheduling, storage zone mapping, and FIFO/FEFO inventory control.</li>
<li><strong>Customer Portal</strong> — Importers and exporters track their shipments and download documents 24/7.</li>
</ul>',

                'body_ar'      => '<h2>الأردن: مركز لوجستي إقليمي</h2>
<p>يقع الأردن عند تقاطع الشرق الأوسط ويعالج مليارات الدولارات من التجارة سنوياً عبر ميناء العقبة ومعابره البرية مع المملكة العربية السعودية والعراق وسوريا. تحتاج شركات اللوجستيات العاملة في هذه البيئة إلى أنظمة تعالج الشحن متعدد الوسائط ووثائق الجمارك وتتبع السائقين المباشر وبوابات الخدمة الذاتية للعملاء.</p>

<h2>مميزات نظامنا اللوجستي</h2>
<ul>
<li><strong>إدارة الأسطول</strong> — جداول صيانة المركبات وتتبع استهلاك الوقود وتكامل GPS.</li>
<li><strong>تطبيق جوال للسائقين</strong> — يتلقى السائقون تعيينات التوصيل والتقاط صور تأكيد التسليم وتحديث الحالة في الوقت الفعلي.</li>
<li><strong>تحسين المسارات</strong> — توجيه مدعوم بالذكاء الاصطناعي لتقليل تكلفة الوقود ووقت التسليم عبر شبكة الطرق الأردنية.</li>
<li><strong>تتبع البضائع والشحنات</strong> — تتبع البضائع بالباركود/QR مع تحديثات SMS للعملاء.</li>
<li><strong>وثائق الجمارك والتخليص</strong> — إنشاء قوائم التعبئة وشهادات المنشأ والإقرارات الجمركية المتوافقة مع العقبة والمنافذ الحدودية.</li>
<li><strong>إدارة المستودعات</strong> — جدولة الرصيف ورسم خرائط مناطق التخزين والتحكم في المخزون FIFO/FEFO.</li>
</ul>',
            ],
        ];
    }
}
