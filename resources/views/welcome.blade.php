<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .header h1 {
            color: #3b82f6;
            font-size: 1.25rem;
        }
        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        .search-bar {
            background: #f3f4f6;
            border: none;
            padding: 0.5rem 1rem 0.5rem 2rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 0.5rem center;
            background-size: 1rem;
        }
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            color: #3b82f6;
        }
        .content {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .contacts-list {
            width: 300px;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
        }
        .contact-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .contact-item:hover {
            background-color: #f9fafb;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            margin-right: 1rem;
        }
        .contact-info h3 {
            font-size: 0.875rem;
            font-weight: 500;
        }
        .contact-info p {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .contact-details {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }
        .contact-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        .contact-header .avatar {
            width: 80px;
            height: 80px;
        }
        .contact-header-info {
            margin-left: 1rem;
        }
        .contact-header-info h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .contact-header-info p {
            color: #6b7280;
        }
        .contact-body > div {
            margin-bottom: 1rem;
        }
        .contact-body h3 {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .note {
            background-color: #f3f4f6;
            padding: 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        .tags {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .tag {
            background-color: #e1effe;
            color: #1e40af;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .alphabet-index {
            display: none;
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            padding: 0.5rem;
        }
        .alphabet-index span {
            display: block;
            padding: 2px;
        }
        .bottom-nav {
            display: none;
        }
        @media (max-width: 768px) {
            .container {
                max-width: none;
            }
            .header h1 {
                font-size: 1rem;
            }
            .search-bar {
                width: 150px;
            }
            .contacts-list {
                width: 100%;
            }
            .contact-details {
                display: none;
            }
            .alphabet-index {
                display: block;
            }
            .bottom-nav {
                display: flex;
                justify-content: space-around;
                padding: 1rem;
                background-color: white;
                border-top: 1px solid #e5e7eb;
            }
            .bottom-nav span {
                font-size: 0.75rem;
                color: #6b7280;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Contacts</h1>
            <div class="search-container">
                <input type="search" placeholder="Search 24 contacts" class="search-bar">
                <button class="icon-button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="icon-button" style="color: #9ca3af;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V5.01M12 12V12.01M12 19V19.01M12 6C11.4477 6 11 5.55228 11 5C11 4.44772 11.4477 4 12 4C12.5523 4 13 4.44772 13 5C13 5.55228 12.5523 6 12 6ZM12 13C11.4477 13 11 12.5523 11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12C13 12.5523 12.5523 13 12 13ZM12 20C11.4477 20 11 19.5523 11 19C11 18.4477 11.4477 18 12 18C12.5523 18 13 18.4477 13 19C13 19.5523 12.5523 20 12 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </header>
        <main class="content">
            <div class="contacts-list">
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Jen Olson</h3>
                        <p>Be you Fitness, Personal Trainer</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Kevin Jones</h3>
                        <p>Living Designs, Head Architect</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Trevor Thomas</h3>
                        <p>Head Recruiting, Head Recruiter</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Margot Bardeau</h3>
                        <p>HM Consulting, Consultant</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Nina Short</h3>
                        <p>Super Media, Digital Media Manager</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Joann Short</h3>
                        <p>Venture Capitalist</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Jay Price</h3>
                        <p>Price Financial, Financial Planner</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="avatar"></div>
                    <div class="contact-info">
                        <h3>Rick Klau</h3>
                        <p>Google Ventures, Partner</p>
                    </div>
                </div>
            </div>
            <div class="contact-details">
                <div class="contact-header">
                    <div class="avatar"></div>
                    <div class="contact-header-info">
                        <h2>Jen Olson</h2>
                        <p>Be you Fitness, Personal Trainer</p>
                    </div>
                </div>
                <div class="contact-body">
                    <div>
                        <h3>Phone</h3>
                        <p>303.222.5667</p>
                    </div>
                    <div>
                        <h3>Address</h3>
                        <p>1234 W Acorn Pkwy</p>
                        <p>Denver, Colorado 80202</p>
                        <p>USA</p>
                    </div>
                    <div>
                        <h3>Private note</h3>
                        <p class="note">Met at conference in Austin TX. Would like to discuss partnering opportunities.</p>
                    </div>
                    <div>
                        <a href="#" style="color: #3b82f6; font-size: 0.875rem;">Add private Tag</a>
                        <div class="tags">
                            <span class="tag">Conference Contacts</span>
                            <span class="tag" style="background-color: #dcfce7; color: #166534;">Lead</span>
                        </div>
                    </div>
                    <div>
                        <h3>Workspaces</h3>
                        <p style="color: #6b7280; font-size: 0.875rem;">Not currently shared with any workspaces.</p>
                        <a href="#" style="color: #3b82f6; font-size: 0.875rem;">Add to workspace</a>
                    </div>
                </div>
            </div>
        </main>
        <div class="alphabet-index">
            <span>A</span><span>B</span><span>C</span><span>D</span><span>E</span><span>F</span><span>G</span>
            <span>H</span><span>I</span><span>J</span><span>K</span><span>L</span><span>M</span><span>N</span>
            <span>O</span><span>P</span><span>Q</span><span>R</span><span>S</span><span>T</span><span>U</span>
            <span>V</span><span>W</span><span>X</span><span>Y</span><span>Z</span><span>#</span>
        </div>
        <nav class="bottom-nav">
            <span>Contacts</span>
            <span>Assistant</span>
            <span>Settings</span>
        </nav>
    </div>
</body>
</html>