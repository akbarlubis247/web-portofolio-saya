<?php

namespace Database\Seeders;

use App\Models\PortfolioSetting;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    /**
     * ============================================================
     * KREDENSIAL ADMIN — LIHAT DI SINI JIKA LUPA PASSWORD
     * ============================================================
     * Username : akbarsebagaiadmin
     * Password : mafisakbaradmin123
     * Login URL: /admin/login
     * ============================================================
     */
    public const ADMIN_USERNAME = 'akbarsebagaiadmin';

    public const ADMIN_PASSWORD = 'mafisakbaradmin123';

    public function run(): void
    {
        User::updateOrCreate(
            ['username' => self::ADMIN_USERNAME],
            [
                'name' => 'Muhammad Akbar Rafliansyah Lubis',
                'email' => 'akbarlubis247@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make(self::ADMIN_PASSWORD),
            ]
        );

        PortfolioSetting::updateOrCreate(['id' => 1], [
            'name' => 'Muhammad Akbar Rafliansyah Lubis',
            'title' => 'Data Analyst',
            'tagline' => 'Passionate about data, insights, and visualization',
            'about_bio' => 'Saya Adalah Mahasiswa D4 Teknologi Rekayasa Perangkat Lunak dari IPB University dengan MInat di bidang Analisis Data. saya senang mengolah data Mentah menjadi suatu insight yang dapat membantu pengambilan suatu keputusan',
            'career_goal' => 'Menjadi Data Analyst profesional yang mampu mengubah data menjadi strategi bisnis yang actionable, serta terus berkembang di bidang machine learning dan business intelligence.',
            'email' => 'akbarlubis247@gmail.com',
            'whatsapp' => '+62 812-1315-0137',
            'linkedin' => 'https://www.linkedin.com/in/akbar-rafliansyah-314b1b374?utm_source=share_via&utm_content=profile&utm_medium=member_android',
            'github' => 'https://github.com/akbarlubis247',
            'avatar_path' => 'avatars/ssPdoIFxhrNXuEjheukordPShIcAWkGjhysiG5mU.jpg',
            'skills' => [
                ['name' => 'Python', 'detail' => 'Pandas, NumPy, Matplotlib', 'icon' => 'python'],
                ['name' => 'SQL', 'detail' => 'Query & Database Management', 'icon' => 'database'],
                ['name' => 'Excel', 'detail' => 'Advanced Spreadsheet Analysis', 'icon' => 'table'],
                ['name' => 'Data Visualization', 'detail' => 'Power BI & Tableau', 'icon' => 'chart'],
                ['name' => 'Statistics', 'detail' => 'Hypothesis Testing & EDA', 'icon' => 'stats'],
                ['name' => 'Tools & Kode', 'detail' => 'VS Code, Cursor, Git', 'icon' => 'code'],
            ],
        ]);

        $projects = [
            [
                'title' => 'Sales Data Analysis',
                'slug' => 'sales-data-analysis',
                'description' => 'Analisis data penjualan retail selama 2 tahun untuk mengidentifikasi tren, produk terlaris, dan pola perilaku pelanggan.',
                'problem' => 'Perusahaan retail menghadapi penurunan penjualan di beberapa kategori produk tanpa pemahaman yang jelas tentang penyebabnya. Manajemen membutuhkan analisis data penjualan dan perilaku pelanggan.',
                'insight' => "• 20% pelanggan (Champions) menyumbang 60% total revenue\n• Kategori Electronics menyumbang 35% total revenue\n• Pertumbuhan penjualan 15% YoY\n• Weekend menghasilkan 40% lebih banyak transaksi\n• Rekomendasi: fokus retensi Champions & optimasi diskon 15-20%",
                'tools' => ['Python', 'Pandas', 'Matplotlib', 'Seaborn'],
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
                'github_link' => 'https://github.com/akbarlubis247',
                'project_date' => '2025-11-15',
            ],
            [
                'title' => 'Customer Segmentation',
                'slug' => 'customer-segmentation',
                'description' => 'Segmentasi pelanggan menggunakan K-Means clustering untuk strategi marketing yang lebih targeted.',
                'problem' => 'Tim marketing membutuhkan segmentasi pelanggan yang jelas untuk mempersonalisasi kampanye dan meningkatkan conversion rate.',
                'insight' => "• 4 segment teridentifikasi: High Spenders, Budget Conscious, Occasional Buyers, Premium Loyalists\n• Elbow method menentukan k=4 cluster optimal\n• Setiap segment memerlukan strategi marketing berbeda",
                'tools' => ['Python', 'Scikit-learn', 'Pandas', 'Matplotlib'],
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'github_link' => 'https://github.com/akbarlubis247',
                'project_date' => '2025-09-20',
            ],
            [
                'title' => 'Sales Dashboard - Power BI',
                'slug' => 'sales-dashboard-power-bi',
                'description' => 'Interactive dashboard untuk monitoring KPI penjualan real-time menggunakan Power BI.',
                'problem' => 'Stakeholder membutuhkan visualisasi data penjualan yang mudah dipahami dan dapat diakses secara real-time.',
                'insight' => "• Dashboard mengurangi waktu pelaporan dari 2 hari menjadi real-time\n• 5 halaman: Overview KPI, Sales Trend, Product Analysis, Regional Performance, Customer Insights\n• Single source of truth untuk tim sales dan manajemen",
                'tools' => ['Power BI', 'DAX', 'SQL', 'Excel'],
                'image_url' => 'https://images.unsplash.com/photo-1543286386-713bdd548da4?auto=format&fit=crop&w=800&q=80',
                'github_link' => 'https://github.com/akbarlubis247',
                'demo_link' => 'https://app.powerbi.com/view',
                'project_date' => '2025-12-01',
            ],
        ];

        foreach ($projects as $data) {
            Project::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_published' => true])
            );
        }

        $certifications = [
            [
                'title' => 'Google Data Analytics Professional Certificate',
                'issuer' => 'Google / Coursera',
                'issue_date' => '2025-05-10',
                'expiration_date' => null,
                'credential_id' => 'GDA-2025-99812',
                'credential_url' => 'https://www.coursera.org/account/accomplishments/verify/google-data-analytics',
                'image_url' => 'https://images.credly.com/size/340x340/images/82dfc700-1c4b-4a5f-9e6e-213c4c92e9a7/Google_Data_Analytics.png',
                'is_published' => true,
            ],
            [
                'title' => 'Microsoft Certified: Power BI Data Analyst Associate',
                'issuer' => 'Microsoft',
                'issue_date' => '2025-08-15',
                'expiration_date' => '2026-08-15',
                'credential_id' => 'MS-PL300-88412',
                'credential_url' => 'https://learn.microsoft.com/credentials/',
                'image_url' => 'https://images.credly.com/size/340x340/images/e7e9f3b5-7157-4f6c-8517-73d8a5712170/microsoft-certified-associate-badge.png',
                'is_published' => true,
            ],
            [
                'title' => 'IBM Data Science Professional Certificate',
                'issuer' => 'IBM / Coursera',
                'issue_date' => '2025-10-20',
                'expiration_date' => null,
                'credential_id' => 'IBM-DS-55421',
                'credential_url' => 'https://www.coursera.org/account/accomplishments/verify/ibm-data-science',
                'image_url' => 'https://images.credly.com/size/340x340/images/945952e4-e0b4-436f-8700-0a374668b5a0/IBM_Data_Science_Professional_Certificate.png',
                'is_published' => true,
            ],
        ];

        foreach ($certifications as $cert) {
            \App\Models\Certification::updateOrCreate(
                ['title' => $cert['title']],
                $cert
            );
        }
    }
}
