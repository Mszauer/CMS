TRUNCATE TABLE categoires;
TRUNCATE TABLE comments;
TRUNCATE TABLE posts;
TRUNCATE TABLE users

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP'),
(17, 'Test'),
(18, 'Demo');

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_author`, `comment_content`, `comment_status`) VALUES
(16, 16, '2017-03-06', 'Visitor                    ', 'This is a pretty cool blog post!', 'approved');

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(16, 2, 'Convert String to DOM Nodes', 'David Walsh', '2017-03-06', 'JavaScriptListImage.png', 'It wasn''t too long ago that browsers were mostly stagnant when it came to implementing new APIs and features, leading to the rise of MooTools (FTW), jQuery, Dojo Toolkit, Prototype, and likewise JavaScript toolkits. Then we started doing more client side rendering and were forced to use a variety of tricks to handle templates, including massive HTML strings in our JavaScript and even abusing tags to hold our templates.\r\nPlease read more at: https://davidwalsh.name/convert-html-stings-dom-nodes', 'Javascript, David, Walsh, API, DOM', 2, 'published'),
(17, 18, 'Predicting Marketing Campaign Response Using Amazon Machine Learning', 'Chris Mohritz', '2017-03-06', 'images.jpg', 'Today, marketers are challenged with higher expectations and thinner budgets.\r\nSo figuring out where to invest your advertising dollars to drive the highest ROI is critical. Fortunately, artificial intelligence (A.I.) tools are making that decision easier and easier every day.\r\nImagine if you had a crystal ball that allowed you to peer into the future and see exactly who is going to respond to your offer.\r\nHow profitable would your marketing campaigns be if you knew exactly who is going to convert and who isnâ€™t before you even launch the campaign?\r\nBut the formula for a successful marketing campaign canâ€™t be pinned down to a single factor. In fact, it could take a mountain of data to figure out the best strategy.\r\nThatâ€™s where A.I. â€” or more specifically, machine learning â€” comes in.\r\nfull blog post located here: https://gigaom.com/2017/02/27/predicting-marketing-campaign-response-using-amazon-machine-learning/', 'Marketing, AI', 0, 'published'),
(18, 18, 'Creating Content Outside Your Niche', 'David Molnar', '2017-03-06', 'hires.jpg', 'If youâ€™ve gotten the feeling that your audience and readership are dropping off, it might be because your content has gone stale. Over time, even the best writers start to play out their audience and topics. \r\nFor example, you can only cover the subject of search engine optimization or pay-per-click advertising so many times before people get tired of hearing your take on it. While these topics are important, crafting content outside your established niches can be the perfect way to revitalize your audience and earn new readers. \r\nFor best results, start writing about topics that are related to but slightly outside of your area of expertise. For example, if you run a small digital marketing business and typically write about content creation and SEO, you could start writing about entrepreneurship, as well. Going off-topic will give your readers something fresh to connect with and help you gain new audiences. \r\nRead more at: http://www.bloggersentral.com/2017/02/creating-content-outside-your-niche_5.html', 'New, Uncomfortable, OutOfBounds', 0, 'published'),
(19, 18, 'How to Make YouTube Playlists with a Google Spreadsheet', 'Labnol', '2017-03-06', 'unnamed.png', 'A couple of YouTube videos, some simple Google formulas and a Google Spreadsheet â€“ thatâ€™s all you need to quickly create a YouTube playlist. It will be an anonymous playlist, not connected to your YouTube channel, and may be a good way to bunch together multiple videos for easy sharing on WhatsApp, Twitter or an email newsletter.\r\nRead more at: https://www.labnol.org/internet/youtube-playlist-spreadsheet/29183/', 'Youtube, Spreadsheet, lifehack', 0, 'published');

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(7, 'mszauer', '$2Cw51.ICu1Nw', 'martin', 'szauer', '123@123', '', 'admin', '$2y$10iusesomecrazystrings22'),
(9, 'Visitor', '$275WXzW.UW/2', 'Visitor', 'Visiting', 'visitor@visiting.com', 'defaultIcon.png', 'admin', '$2y$10iusesomecrazystrings22'),
(11, 'admin', '$2wdSAngDShks', '', '', 'admin@admin.com', '', 'admin', '$2y$10iusesomecrazystrings22');
