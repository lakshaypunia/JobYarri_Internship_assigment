<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $blogs = [
            [
                'title'             => 'SSC CGL 2024 Admit Card Released',
                'short_description' => 'Download your SSC CGL 2024 admit card from the official portal before the exam date.',
                'content'           => 'The Staff Selection Commission has released the admit card for the SSC CGL 2024 Tier-1 examination. Candidates who registered for the exam can now download their hall ticket from the official SSC website. The exam is scheduled to be held from September 9 to September 26, 2024. Candidates must carry a printout of the admit card along with a valid photo ID proof to the examination centre. No candidate will be allowed entry without the hall ticket.',
                'published_at'      => '2024-08-15',
            ],
            [
                'title'             => 'UPSC Civil Services Result 2023 Declared',
                'short_description' => 'UPSC has declared the final result of Civil Services Examination 2023. Check the merit list now.',
                'content'           => 'The Union Public Service Commission (UPSC) has announced the final result of the Civil Services Examination 2023. A total of 1016 candidates have been recommended for appointment to IAS, IFS, IPS and other Group A and Group B Central Services. Candidates can check their result on the official UPSC website. The topper of this year\'s examination is from Rajasthan. Detailed score cards and marks will be uploaded separately on the official website.',
                'published_at'      => '2024-04-16',
            ],
            [
                'title'             => 'IBPS PO Answer Key 2024 Out',
                'short_description' => 'IBPS has released the provisional answer key for PO Prelims 2024. Raise objections by Oct 5.',
                'content'           => 'The Institute of Banking Personnel Selection (IBPS) has published the provisional answer key for IBPS PO Prelims 2024. Candidates who appeared in the exam can download the answer key and compare their responses. The objection window is open from October 2 to October 5, 2024. Candidates can raise objections by paying a fee of Rs. 50 per question. The final answer key will be released after reviewing all objections.',
                'published_at'      => '2024-10-02',
            ],
            [
                'title'             => 'RRB NTPC Syllabus 2024 – Complete Guide',
                'short_description' => 'Get the complete RRB NTPC 2024 syllabus for CBT 1 and CBT 2 with topic-wise weightage.',
                'content'           => 'The Railway Recruitment Board has released the official syllabus for RRB NTPC 2024. The examination consists of two stages – CBT 1 and CBT 2. CBT 1 covers Mathematics, General Intelligence & Reasoning, and General Awareness. CBT 2 covers General Awareness, Mathematics, and General Intelligence & Reasoning with a higher difficulty level. Candidates are advised to follow the official syllabus strictly and prepare from standard books. Mock tests and previous year papers are also recommended.',
                'published_at'      => '2024-06-10',
            ],
            [
                'title'             => 'SBI Clerk Recruitment 2024 – 13,735 Vacancies',
                'short_description' => 'SBI has announced 13,735 vacancies for Junior Associates. Apply online before the last date.',
                'content'           => 'State Bank of India (SBI) has released a bumper recruitment notification for Junior Associates (Customer Support & Sales) posts. A total of 13,735 vacancies are available across various states. Candidates with a graduation degree in any discipline are eligible to apply. The online application process has started and will remain open for 30 days. The selection process includes Preliminary Examination, Main Examination, and Local Language Test. The pay scale for the post ranges from Rs. 17,900 to Rs. 47,920.',
                'published_at'      => '2024-09-01',
            ],
            [
                'title'             => 'CTET December 2024 Admit Card Download Link',
                'short_description' => 'CBSE has activated the CTET December 2024 admit card link. Steps to download inside.',
                'content'           => 'The Central Board of Secondary Education (CBSE) has released the admit card for CTET December 2024. Candidates can download their hall ticket from ctet.nic.in using their application number and date of birth. The exam will be conducted in two shifts – Paper 1 from 9:30 AM to 12:00 PM and Paper 2 from 2:30 PM to 5:00 PM. Candidates are advised to check the exam city and centre details carefully and report to the venue at least 90 minutes before the exam.',
                'published_at'      => '2024-11-20',
            ],
            [
                'title'             => 'NEET UG 2024 Result – Scorecard & Merit List',
                'short_description' => 'NTA has declared the NEET UG 2024 result. Download your scorecard and check the merit list.',
                'content'           => 'The National Testing Agency (NTA) has declared the NEET UG 2024 result on its official website neet.ntaonline.in. Candidates can log in using their application number and date of birth to check their scores. This year, more than 24 lakh students appeared for the examination. The merit list has been prepared based on the marks obtained in Physics, Chemistry, and Biology. Candidates qualifying the NEET UG cut-off are eligible for MBBS, BDS, AYUSH, and other medical courses.',
                'published_at'      => '2024-06-04',
            ],
            [
                'title'             => 'Delhi Police Constable Answer Key 2024',
                'short_description' => 'SSC has released the Delhi Police Constable answer key. Objection window closes Nov 10.',
                'content'           => 'The Staff Selection Commission has published the provisional answer key for the Delhi Police Constable Exam 2024. Candidates can download the response sheet and answer key from the official SSC portal. The exam was conducted in computer-based mode across multiple shifts. Objections against any answer can be raised till November 10, 2024 by paying Rs. 100 per question. Final answer keys will be published post scrutiny and the result is expected within 45 days.',
                'published_at'      => '2024-11-05',
            ],
            [
                'title'             => 'UP Police Constable Recruitment 2024 – 60,244 Posts',
                'short_description' => 'UPPRPB announces 60,244 constable vacancies. Check eligibility and apply before the deadline.',
                'content'           => 'The Uttar Pradesh Police Recruitment and Promotion Board (UPPRPB) has released a mega recruitment notification for 60,244 Constable Civil Police posts. This is one of the largest police recruitment drives in the country. Male and female candidates between 18 to 22 years (with relaxation for reserved categories) are eligible to apply. Selection is based on a written exam, physical efficiency test, and document verification. The application form is available on uppbpb.gov.in.',
                'published_at'      => '2024-12-01',
            ],
            [
                'title'             => 'SSC MTS 2024 Syllabus and Exam Pattern',
                'short_description' => 'Complete SSC MTS 2024 syllabus with subject-wise topics and marking scheme explained.',
                'content'           => 'The Staff Selection Commission Multi Tasking Staff (SSC MTS) 2024 exam will be held in Computer Based Test mode. The exam consists of two sessions on the same day. Session 1 covers Numerical and Mathematical Ability and Reasoning Ability & Problem Solving. Session 2 covers General Awareness, English Language & Comprehension. There is no negative marking for Session 1 and a deduction of 1 mark per wrong answer in Session 2. Candidates should focus on speed and accuracy for this exam.',
                'published_at'      => '2024-07-22',
            ],
        ];

        foreach ($blogs as $index => $blogData) {
            $category = $categories[$index % $categories->count()];
            Blog::create(array_merge($blogData, ['category_id' => $category->id]));
        }
    }
}
