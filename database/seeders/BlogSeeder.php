<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $cat = Category::pluck('id', 'slug');

        $blogs = [
            [
                'category_id'       => $cat['admit-card'],
                'title'             => 'GATE 2027 Admit Card Released - Direct Download Link Inside',
                'short_description' => 'The Indian Institute of Technology (IIT) has officially released the admit cards for the Graduate Aptitude Test in Engineering (GATE) 2027.',
                'content'           => 'Candidates who registered for the GATE 2027 examination can now download their official admit cards from the online application portal. To download the hall ticket, candidates must enter their enrollment ID/email address and password. Make sure to verify your exam center location, reporting time, and papers chosen. It is mandatory to carry a printed color copy of this admit card along with an original valid photo identification card to the examination center without exception.',
            ],
            [
                'category_id'       => $cat['result'],
                'title'             => 'UPSC Civil Services 2025 Final Results Declared',
                'short_description' => 'The Union Public Service Commission has announced the final recommendations list for the prestigious Civil Services Examination 2025.',
                'content'           => 'The Union Public Service Commission (UPSC) has declared the final results for the CSE 2025 cycle today. A total of 933 candidates have been recommended for appointment to various administrative services including IAS, IFS, and IPS. The merit list is based on the combined marks scored in the Written Main Examination and the subsequent Personality Test interviews conducted between January and May. Candidates can view the full PDF list sorted by roll numbers on the official portal.',
            ],
            [
                'category_id'       => $cat['job-notification'],
                'title'             => 'ISRO Recruitment 2026: Openings for Scientist and Engineer SC Posts',
                'short_description' => 'The Indian Space Research Organisation (ISRO) invites online applications from dynamic Computer Science, Electronics, and Mechanical graduates.',
                'content'           => 'ISRO Centralised Recruitment Board (ICRB) has published a detailed notification offering rewarding career paths for young engineering professionals. There are a total of 320 vacancies across multiple space application centers. Eligible candidates must have a first-class B.E./B.Tech degree with an aggregate minimum of 65% marks. Selection will be stringently mapped through a national written examination followed by technical panel interviews for shortlisted profiles.',
            ],
            [
                'category_id'       => $cat['tech-tutorials'],
                'title'             => 'Mastering Dynamic AJAX Filters in Laravel 11 Apps',
                'short_description' => 'Learn how to build incredibly fast asynchronous searching and filtering interfaces using jQuery and Laravel partial blades.',
                'content'           => 'Modern web development values fluid user interactions. Refreshing an entire web page just because a user wants to view items from a different category hurts user retention metrics. In this comprehensive guide, we unpack how to decouple your Eloquent controller queries, track user inputs natively with jQuery event listeners, and completely replace target DOM containers with pre-rendered server partial layouts inside asynchronous HTTP loops.',
            ],
            [
                'category_id'       => $cat['admit-card'],
                'title'             => 'IBPS PO 2026 Prelims Call Letter Available for Download',
                'short_description' => 'The Institute of Banking Personnel Selection has issued the prelims admit card for Probationary Officers selection scale.',
                'content'           => 'Registered bank job aspirants can access their online exam call letters starting today. The window to access downloads will remain operational until the day of your examination. You must log in using your registration number and date of birth (DD-MM-YYYY). Be sure to carefully read the extensive safety protocols and instructions concerning biometric capturing workflows outlined inside the document.',
            ],
            [
                'category_id'       => $cat['result'],
                'title'             => 'JEE Advanced 2026 Answer Key and Response Sheet Update',
                'short_description' => 'The organizing IIT has uploaded candidate response sheets alongside the preliminary key for challenge submissions.',
                'content'           => 'Students who appeared for both papers of JEE Advanced can now evaluate their tentative raw scores. The portal allows matching personal recorded responses against the official master key. If any student flags an analytical error in standard marking parameters, they can lodge an online challenge by paying a nominal fee per question before the server access closes this weekend.',
            ],
            [
                'category_id'       => $cat['job-notification'],
                'title'             => 'BARC OCES/DGFS 2026 Professional Trainee Opportunities',
                'short_description' => 'Bhabha Atomic Research Centre announces orientation courses for engineering graduates and science post-graduates.',
                'content'           => 'BARC invites high-caliber scientific minds to secure recruitment into its cutting-edge nuclear research facilities. Applicants can qualify via either their valid GATE scorecard or by taking the dedicated BARC computer-based screening test. Successful trainees undergo rigorous engineering specialization courses and graduate straight into specialized Officer positions within the Department of Atomic Energy.',
            ],
            [
                'category_id'       => $cat['tech-tutorials'],
                'title'             => 'Understanding Database Indexing Strategies in MySQL',
                'short_description' => 'Why are your database filter loops lagging? Learn how to strategically use indexes to optimize heavy query sorting.',
                'content'           => 'As your blogs table scales from 10 rows to 100,000 records, standard sequential table scans run slower. By strategically placing indexes on heavily filtered columns like category_id or created_at, you construct lightning-fast B-Tree lookup mechanisms. This guide details when to use single-column indexes, composite index patterns, and how to read internal query execution logs to spot system performance traps.',
            ],
            [
                'category_id'       => $cat['admit-card'],
                'title'             => 'SSC CGL 2026 Tier-1 Exam Schedule and City Intimation Slip',
                'short_description' => 'The Staff Selection Commission has activated the status link to check exam dates, shift timing, and assigned testing cities.',
                'content'           => 'The Staff Selection Commission has initiated regional rollouts of exam city location slips for the Combined Graduate Level Examination Tier-1. This preliminary status release ensures candidates can book necessary travel accommodations in advance. The actual entry admit card containing exact block addresses will be unlocked for printing precisely four days prior to your assigned exam date.',
            ],
            [
                'category_id'       => $cat['result'],
                'title'             => 'GATE 2026: IIT Bombay Releases Official Cut-Off Marks',
                'short_description' => 'Check the official category-wise qualifying marks for Computer Science, Data Science, and core branches.',
                'content'           => 'IIT Bombay has published the formal score statistics and qualifying cut-offs alongside personal scorecard links. For the Computer Science and Information Technology (CS) stream, the general category threshold settled at a competitive margin. Scores are calculated out of a normalized standard scale of 1000, and candidates can now utilize these to register for M.Tech admissions via the COAP portal.',
            ],
            [
                'category_id'       => $cat['job-notification'],
                'title'             => 'DRDO Recruitment: Openings for Junior Research Fellows (JRF)',
                'short_description' => 'Defence Research and Development Organisation invites applications for specialized computational fellowship programs.',
                'content'           => 'The Combat Vehicles Research and Development Establishment (CVRDE), a premier laboratory under DRDO, is seeking highly motivated research fellowship applications. The chosen fellows will collaborate on complex AI vision systems and next-generation military simulation frameworks. The initial tenure spans two full operational years with attractive performance-linked stipend enhancements.',
            ],
            [
                'category_id'       => $cat['tech-tutorials'],
                'title'             => 'Securing Laravel REST APIs Against Web Vulnerabilities',
                'short_description' => 'A deep dive into cross-site scripting (XSS), SQL Injection defenses, and implementing secure request routing.',
                'content'           => 'Security is never an afterthought. Thankfully, Laravel\'s core framework layers run robust default shields like automatic SQL param binding via Eloquent and token validation checks across post routes. However, raw inputs must always be handled with caution when rendering dynamic rich text scripts or injecting unfiltered query parameters directly into database queries. Learn to sanitize fields safely using built-in middleware configurations.',
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }
    }
}
