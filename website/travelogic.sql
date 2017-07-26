-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 02:01 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelogic`
--
CREATE DATABASE IF NOT EXISTS `travelogic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `travelogic`;

-- --------------------------------------------------------

--
-- Table structure for table `citydetails`
--

CREATE TABLE `citydetails` (
  `cityID` int(3) NOT NULL,
  `city` varchar(50) NOT NULL,
  `city_description` varchar(2000) NOT NULL,
  `city_image` varchar(2000) NOT NULL,
  `city_image_description` varchar(2000) NOT NULL,
  `city_image2` varchar(2000) NOT NULL,
  `city_image_description2` varchar(2000) NOT NULL,
  `city_image3` varchar(2000) NOT NULL,
  `city_image_description3` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citydetails`
--

INSERT INTO `citydetails` (`cityID`, `city`, `city_description`, `city_image`, `city_image_description`, `city_image2`, `city_image_description2`, `city_image3`, `city_image_description3`) VALUES
(1, 'Brisbane, Australia', 'Combine art and outdoor adventure in Brisbane, where creative spaces, music and hip new restaurants meet pretty riverside gardens and man-made beaches. Explore the sun-soaked capital over a couple of days or a few weeks with one of our travel packages.', 'https://img.buzzfeed.com/buzzfeed-static/static/2015-04/30/23/enhanced/webdr10/enhanced-buzz-12355-1430452281-15.jpg?no-auto', 'Holloway is the kind of place you can only find at West End. By day, it’s a shop selling eyewear and watches made from old skateboards. At night, it transforms into an outstanding Italian restaurant.', 'http://www.weekendnotes.com/im/001/01/whites-hill-reserve-brisbane-0901.JPG', 'The trees, the cliffs, and the water make for a perfect lunchtime picnic scene. This serene patch of bushland is conveniently located in the suburbs, meaning you don’t have a long drive to get close to nature.', 'https://www.artmuseum.uq.edu.au/filething/get/5033/About-us-building-photo.jpg\r\n', 'The Queensland Art Museum presents an evolving program of Australian and international exhibitions, with a focus on the contemporary art of Australia, Asia and the Pacific. Immerse the family in creativity at the Children’s Art Centre and see the best in international film and video at the Australian Cinémathèque. QAGOMA offers cafes, modern dining and shopping to complete your visit.'),
(2, 'Paris, France', 'Paris can be seen as the most interesting city of Europe and probably even as one of the most amazing city’s worldwide. People from all over the world travel to Paris to discover and experience this fairy-like city. Paris is the city of love, inspiration, art and fashion.', 'http://xdaysiny.com/wp-content/uploads/2015/07/rue-mouffetard-latin-quarter-breakfast.jpg', 'The Rue Mouffetard is home to the Latin Quarter in Paris. The street itself is a cobblestone lane that winds its way up the hill to Place de la Contrescarpe. It was actually an ancient Roman road that led from Paris to Rome, and this area still retains a medieval look and feel. The bottom of Rue Mouffetard is where you’ll find excellent spots for breakfast, along with the bulk of the fruit & vegetable shops.', 'http://www.lolwot.com/wp-content/uploads/2015/05/20-secret-places-you-need-to-visit-in-paris-6.jpg', 'The Parc des Buttes-Chaumont has its own grotto, waterfall and suspension bridge. A popular among the locals, the park feels like a small slice of paradise in the city and if you’re looking for a little down time, is a great place to come and rest.', 'https://c1.staticflickr.com/7/6133/5934508718_49dbf35fcd_b.jpg', 'Go to Les Philosophes for french onion soup With rich beef broth loaded with a soft sweet hash of sautéed onions under a cap of melted cheese floating on a crouton buoy — is one of those dishes the whole world thinks of as quintessentially Parisian. Despite its icon status, few restaurants have an eternal stockpot going anymore. That’s why the soup served at this café is such a treat, and it’s only nine Euros!'),
(3, 'Tokyo, Japan', 'Tokyo, is becoming one of the world&#39;s most exciting travel destinations: it is bursting with excellent restaurants; its nightlife is one of the hottest in the world; the shopping scene is constant day and night; the crime rate is virtually non-existent; there are fascinating ancient sites to be explored; and the public transport is arguably the most efficient in the world. This vibrant city is waiting for you!', 'https://media-cdn.tripadvisor.com/media/photo-s/0c/35/0c/80/shrine.jpg', 'For those who donï¿½t mind a good scare, you can chose one of six tours on the list ï¿½ namely ghosts and goblins of old Tokyo, backstreets ghost walk, blood of samurai, demons of the red light district, graveyard mystery tour and custom of the day. The knowledgeable tour guides speak different languages and will not only introduce you to ghost stories but they will also take you to various off-the-beaten-path sites around the city.', 'https://cdn.theculturetrip.com/wp-content/uploads/2015/12/9122772787_d0bf00a26b_o.jpg', 'Golden Gai, in Shinjuku, is famous for both its architectural value and its vibrant nightlife, yet not many tourists seem to come here. Youï¿½ll find Golden Gai just a few minutes walk away from the east exit of Shinjuku Station. Golden Gai is a network of six narrow alleys connected by small passageways. There are more than 200 crudely built bars, clubs and restaurants that promise unforgettable entertainment and a variety of Japanese meals and drinks.', 'https://cdn0.vox-cdn.com/thumbor/j5VgfRUAOvV3ALYJ7eiHxA7OZF8=/146x0:733x440/520x390/filters:focal(146x0:733x440):format(webp)/cdn0.vox-cdn.com/uploads/chorus_image/image/49646941/tofuya-ukai-official-site.0.0.jpg', 'Built around a beautiful traditional garden, Tofuya Ukaiï¿½s low-rise complex of private rooms offers a glimpse of how Tokyo used to look and dine before the modern high-rise city developed. Multi-course meals include elaborate appetizers ï¿½ like the specialty artisan bean curd served in hot pots in winter or chilled in summer ï¿½ and culminate in servings of fish or meat grilled at the table.'),
(4, 'Lodon, England', 'London is London, and no other city in the world is like it. Its attractions and places of interest are countless and cater for all tastes and all ages; its shops - small and large - are often unforgettable; its culture - theatres and museums combined - in a class of its own.', 'https://img.buzzfeed.com/buzzfeed-static/static/2014-06/16/10/enhanced/webdr03/enhanced-27879-1402928051-20.jpg?no-auto', 'Wilton''s Music Hall is said to be the oldest music hall in the world. It was founded in 1743 as an ale house for sea captains but became a music hall in the 1800s. Nowadays, it is a beautiful grade 2* listed building, concert hall and events hub.', 'https://img.buzzfeed.com/buzzfeed-static/static/2014-06/17/7/enhanced/webdr06/enhanced-12881-1403003023-5.jpg?no-auto', 'St Dunstan-in-the-East is situated between London Bridge and the Tower of London and was built in 1100. It suffered from fire damage from the Great Fire of London in 1666. It was patched up and a Sir Christopher Wren-designed steeple added in 1695. It was severely hit during the Blitz in 1941 and the ruins were turned into a public garden in 1971.', 'https://cdn0.vox-cdn.com/thumbor/aoIkRDPF4RyXPXRNocXckCxvY_g=/170x0:2837x2000/520x390/filters:focal(170x0:2837x2000):format(webp)/cdn0.vox-cdn.com/uploads/chorus_image/image/49650797/Fernandez_Wells_USE.0.0.jpg', 'Fernandez and Wells, come to this restaurant for delicious food. The shops have inspired a generation of third-wave cafes and "delis," according to a bold, utilitarian template. Each lunchtime, on top of heavy wood counters, piles of rustic sandwiches tempt ad execs and actor agents because they taste as good as they look.'),
(5, 'Rome, Italy', 'For Rome as much as its great monuments ï¿½ the Colosseum, St Peterï¿½s Basilica, the Pantheon ï¿½ is that there are a lot to discover about Rome. It is all in the details: the cobbled lanes and hidden corners, the vivid colors, the aroma of freshly ground coffee wafting out of its cafes. Rome&#39;s streets and piazzas are an endless source of entertainment', 'http://www.planetware.com/photos-large/I/italy-rome-roman-forum-overview.jpg', 'The Roman Forum was ancient Rome&#39;s showpiece centre, a district of temples, basilicas and vibrant public spaces. The site, which was originally a burial ground, was first developed in the 7th century BC, growing over time to become the social, political and commercial hub of the Roman empire. Landmark sights include the Arco di Settimio Severo, the Curia, and the Casa delle Vestali.', 'https://i1.wp.com/luxurycolumnist.com/wp-content/uploads/2015/08/1-villa-medici-rome-visit.jpg', 'Villa Medici is a fantastic location near the Spanish Steps, overlooking the whole city. Built in 1540, it was bought by Ferdinando dei Medici in 1576 and then by Napoleon in 1801. The best French artists, composers and sculptors came here to study, including Boucher, Fragonard, Berlioz, Debussy and the architect of the French opera house, Charles Garnier. These days there are up to 19 French-speaking artists and musicians in residence, and the villa hosts regular exhibitions and performances.', 'https://oldtiogafarm.files.wordpress.com/2014/03/armando.jpg', 'Located 100 feet from Romeï¿½s most intact ancient monument, Armando al Pantheon champions local food traditions. For more than five decades, the Gargioli family has been dutifully producing Roman classics like spaghetti ajo ojo e peperoncino (spaghetti with garlic, oil, and chili).'),
(6, 'New York, New York', 'New York City is one of the most popular tourist destinations in the world, and with good reason. NYC is the mecca of business in the United States, and as a melting pot of American culture, there is something for every style, taste and budget in New York City.', 'http://www.thewholeworldisaplayground.com/wp-content/uploads/2015/03/Secret-New-York.jpg', 'The Morgan Library is one of the most beautiful places we’ve come across in New York City. It began as the private library of financier Pierpont Morgan and his son, J.P. Morgan, transformed it into a public institution. The stunning library is a book lovers dream and the personal study is incredible', 'http://3.bp.blogspot.com/-J3AtlgHz5q4/Tt9tv9hZ-uI/AAAAAAAABvA/jxu8YNE74kg/s1600/berlin+wall+2.JPG', 'You will definitely surprised when you stumble across remnants of the Berlin Wall in the middle of a Manhattan courtyard! There are pieces of the Berlin Wall scattered all over the world and New York has secured its own piece of German history with two sections of the Wall currently on public display: one at Battery Park and the second in the UN plaza.', 'https://cdn0.vox-cdn.com/thumbor/LxiSUpYEdvKv_gs3bZvlLpZ5V3Y=/56x0:943x665/520x390/filters:focal(56x0:943x665):format(webp)/cdn0.vox-cdn.com/uploads/chorus_image/image/46060804/12287874126_45c630af14_b.0.0.0.jpg', 'In 127 years, little has changed at Katz''s. It remains one of New York''s — and the country''s — essential Jewish delicatessens. Every inch of the massive Lower East Side space smells intensely of pastrami and rye loaves. The sandwiches are massive, so they are best when shared. Order at the counter, and don''t forget to tip your slicer — your sandwich will be better for it.'),
(7, 'Kahului, Hawaii', 'Sitting smack dab in the middle of Central Maui, Kahului serves as the commercial hub of local activity. Kahului was developed as the “Dream City,” where plantation workers were finally able to achieve the dream of owning their own home.', 'https://assets0.roadtrippers.com/uploads/poi_gallery_image/image/319718822/-strip_-quality_60_-interlace_Plane_-resize_1024x480_U__-gravity_center_-extent_1024x480/poi_gallery_image-image-f2df08bd-1490-474a-9d16-96752e979ae5.jpg', 'Iao Valley State Monument is the place to be if you like the tropical flora of Hawaii. Take a walk on the ?Iao Needle Lookout Trail and Ethnobotanical Loop learn about the plants that Hawaiians brought.\r\n', 'http://static.panoramio.com/photos/large/13223292.jpg', 'King''s Highway, Hoapili Trail to Hanomanioa Lighthouse and Kamanamana Beach is a 5.6 mile moderately trafficked out and back trail located near Kihei, Hawaii that features beautiful wild flowers and is rated as moderate. The trail offers a number of activity options and is accessible year-round. Dogs are also able to use this trail but must be kept on leash.', 'https://d253b1eioa5z7b.cloudfront.net/venue_images/medium_c4820f8d-00b6-48e6-af51-1805d71a9c08.jpg', 'Da Kitchen has become famous for its creative diverse cuisine with an emphasis on traditional Hawaiian food. The menu incorporates both traditional classic Local and Hawaiian favorites, which is inspired by the different ethnic groups established in the islands of Hawaii. '),
(8, 'Cape Town, South Africa', 'Cape Town has it all: beaches, mountains, harbors and gardens. Beneath the mountains are some of the most picturesque beach communities you’ll ever see. Domestic travel is relatively inexpensive so you can experience all of South Africa without breaking the bank.', 'http://www.travelstart.co.za/blog/wp-content/uploads/2014/05/Beta-Beach.jpg', 'Beta Beach offers a welcome respite from the crowds at Clifton, Camps Bay and Llandudno. A small, pristine stretch of sand frequented by residents who live in the vicinity, truth be told. Although the beach mostly comprises large boulders there is a small section of white sand, and a clear swimming area if you’re brave enough.\r\n', 'http://www.travelstart.co.za/blog/wp-content/uploads/2014/05/Ubuntu-Khayelitsha.jpg', 'Khayelitsha, Cape Town’s biggest informal settlement is rarely explored, but Ubuntu is changing that with their township bicycle tours. The tours, which are conducted in English offer a safe and fun way to explore a new culture and landscape.\r\n\r\n', 'http://www.travelstart.co.za/blog/wp-content/uploads/2014/05/Fish-on-the-Rocks.jpg', 'Stop by for what is arguably some of the freshest seafood in the city, locals know they can rely on Fish on the Rocks in Hout Bay. Known for their delicious fish and chips combo, it’s the authentic experience, and no tour of the Cape Peninsula is complete without stopping here. Think crispy fish and chips with a sea breeze.\r\n'),
(9, 'Sydney, Australia', 'Experience Sydney''s natural beauty and culture around Sydney Harbour and the historic Rocks. Explore famous coastal beaches such as Bondi, Bronte, Coogee and Palm Beach. Bushwalk through Sydney Harbour National Park, dine at world-class restaurants, visit the Blue Mountains. ', 'http://www.planetware.com/photos-large/AUS/australia-sydney-beaches.jpg', 'Sydney is famous for its fabulous beaches. Tucked around the harbor are many sheltered coves with calm water and sugary sands. Less than a 15-minute drive from the city, iconic Bondi Beach beckons with its great surf, café scene, and cosmopolitan vibe.', 'http://thedesignfiles.net/wp-content/uploads/2015/10/Wendy_Whitley_Slide_13-1240x800.jpg', 'Wendy Whitely transformed a derelict public area into a magical garden where she buried her artist husband Brett’s ashes, turning heartache into something to be enjoyed for years to come. With interesting sculptures, a big fig tree for shade, gorgeous colours and views of the harbour, her garden i perfect for a stroll, a picnic or simply to be amongst perfect nature.', 'https://media.timeout.com/images/103002094/750/422/image.jpg', 'Bridging the gap between cheap Thai and a bazillion-course molecular journey at Oscillate Wildly, Bloodwood has been a very welcome addition to the Inner West. If it''s a warm night, get a seat on the massive open balcony. '),
(10, 'Bozeman, Montana', 'Bozeman, Montana, is the northern gateway to Yellowstone National Park. That offers incredible recreational opportunities. The Bozeman area is rich with exciting and memorable experiences. Enjoy the picturesque views, clean air, walking/bike trails, streams and world class recreation.', 'https://upload.wikimedia.org/wikipedia/commons/1/19/Pulpit_Terraces,_Yellowstone_National_Park,_Wyoming,_1898.jpg', 'Yellowstone National Park is much more than hot ground and gushing steam. Located astride the Continental Divide, most of the park occupies a high plateau surrounded by mountains and drained by several rivers. Park boundaries enclose craggy peaks, alpine lakes, deep canyons, and vast forests.', 'http://nwtravelmag.com/wp-content/uploads/2015/07/Tyrant-Kings-photcredit-Museum-of-the-Rockies.jpg', 'The Museum of the Rockies is recognized as one of the world''s finest research and history museums and is renowned for displaying an extensive collection of dinosaur fossils, including a full-scale T. rex skeleton! MOR delights members and visitors with changing exhibits from around the world, permanent indoor and outdoor regional history exhibits, planetarium shows, educational programs, insightful lectures, benefit events, and a museum store.', 'https://media-cdn.tripadvisor.com/media/photo-s/09/78/08/b1/feast-raw-bar-bistro.jpg', 'Feast Bistro serves the best in sustainable seafood and locally sourced meats and produce. Procuring fine ingredients from around the world to supply their fusion bistro/raw bar allows them to share their passion for simply prepared and superbly executed cuisine.');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `image`) VALUES
(1, 'Bob Frank', 'https://wwwnc.cdc.gov/travel/images/travel-industry-cruise.jpg'),
(2, 'Melissa Frank', 'http://www.lifeadvancer.com/wp-content/uploads/2016/01/Remarkable-Changes-After-Traveling.jpg'),
(3, 'Daniel Neri', 'http://crisscrosstvl.com/wp-content/uploads/2016/05/sunset-plane.png');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `rating` int(5) NOT NULL,
  `price` varchar(15) NOT NULL,
  `num_of_beds` varchar(10) NOT NULL,
  `bed_type` varchar(10) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `city`, `rating`, `price`, `num_of_beds`, `bed_type`, `image`) VALUES
(1, 'Conrad Tokyo', 'Tokyo', 4, '289', '2', 'Full', 'https://cdn.kiwicollection.com/media/property/PR002810/xl/002810-11-ChinaBlue.jpg'),
(2, 'Hotel Ryumeikan Tokyo', 'Tokyo', 5, '128', '2', 'Full', 'https://1.bp.blogspot.com/-O1n32otpt7k/VyHvR08cnSI/AAAAAAAAdcc/1ghfp199UjMkt7g1OCVwLh3dwIUBaL2HwCLcB/s1600/04.JPG'),
(3, 'Pullman Paris Montparnasse', 'Paris', 4, '218', '2', 'Single', 'http://www.ahstatic.com/photos/7229_ho_00_p_1376x688.jpg'),
(4, 'Mercure Angouleme Hotel', 'Paris', 4, '130', '1', 'Double', 'https://i.ytimg.com/vi/LDgFxy5OFRo/maxresdefault.jpg'),
(5, 'Ace Hotel New York', 'New York City', 4, '449', '2', 'Double', 'http://www.telegraph.co.uk/content/dam/Travel/hotels/north-america/san-francisco/Ace-hotel-large-xlarge.jpg'),
(6, 'Pod 39 Hotel', 'New York City', 4, '170', '1', 'Twin', 'https://media-cdn.tripadvisor.com/media/photo-s/04/74/1b/da/pod-39-hotel.jpg'),
(7, 'Una Hotel Roma', 'Roma', 4, '211', '1', 'Single', 'https://t-ec.bstatic.com/images/hotel/max1024x768/197/19764637.jpg'),
(8, 'Hotel Artemide', 'Roma', 5, '198', '2', 'Twin', 'http://www.hotelroomsearch.net/im/hotels/it/hotel-artemide-18.jpg'),
(9, 'The Docks on Goodwin', 'Brisbane', 5, '184', '1', 'Queen', 'https://images.trvl-media.com/hotels/5000000/4160000/4151000/4150913/4150913_62_z.jpg'),
(10, 'The Great Southern Hotel', 'Brisbane', 3, '90', '1', 'Queen', 'http://greatsouthernhotel.com.au/wp-content/uploads/2015/02/GSH-Sydney-Hotel-View.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `planeticket`
--

CREATE TABLE `planeticket` (
  `id` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `gate` varchar(3) NOT NULL,
  `seat` varchar(4) NOT NULL,
  `class` varchar(30) NOT NULL,
  `depart_time` varchar(30) NOT NULL,
  `arrival_location` varchar(50) NOT NULL,
  `arrival_time` varchar(30) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planeticket`
--

INSERT INTO `planeticket` (`id`, `price`, `gate`, `seat`, `class`, `depart_time`, `arrival_location`, `arrival_time`, `image`) VALUES
(1, '3,380', 'A1', '1A', 'Premium Economy', '11:01 AM May 4', 'Brisbane(BNE)', '6:10 AM May 5', 'http://scalpmicropigmentationcenter.com/wp-content/uploads/2016/08/queensland-australia.jpg'),
(2, '2,291', 'B10', '25A', 'Economy', '3:45 PM April 19', 'Brisbane(BNE)', '6:10 AM April 20', 'http://scalpmicropigmentationcenter.com/wp-content/uploads/2016/08/queensland-australia.jpg'),
(3, '1,460', 'D9', '18C', 'Economy', '6:00 AM June 7', 'Paris(CDG)', '7:55 AM June 8', 'https://cdn.pariscityvision.com/media/wysiwyg/fiches_enrichies/PJDC/Eiffel_Tower.jpg '),
(4, '5,938', 'D3', '13D', 'Business', '6:40 AM June 16', 'Paris(CDG)', '8:35 AM June 17', 'https://cdn.pariscityvision.com/media/wysiwyg/fiches_enrichies/PJDC/Eiffel_Tower.jpg '),
(5, '1,676', 'F3', '5C', 'Economy', '6:00 AM April 18', 'Tokyo(NRT)', '3:35 PM April 19', 'https://voulezvousdiner.a.cdnify.io/photos/_places/places.tokyo.jpg'),
(6, '2,337', 'C10', '18C', 'Premium Economy', '6:10 AM April 18', 'Tokyo(NRT)', '3:20 PM April 19', 'https://voulezvousdiner.a.cdnify.io/photos/_places/places.tokyo.jpg'),
(7, '1,292', 'F10', '10A', 'Economy', '6:02 AM October 12', 'London(LHR)', '10:45 PM October 12', 'https://static01.nyt.com/images/2015/12/09/travel/09intransitphoto-london/09intransitphoto-london-facebookJumbo.jpg '),
(8, '6,409', 'B7', '17B', 'First', '12:56 PM October 12', 'London(LHR)', '6:20 AM October 13', 'https://static01.nyt.com/images/2015/12/09/travel/09intransitphoto-london/09intransitphoto-london-facebookJumbo.jpg '),
(9, '3,087', 'A11', '21C', 'Business', '8:21 AM November 8', 'Rome(FCO)', '9:10 AM November 9', 'http://www.telegraph.co.uk/content/dam/video_previews/l/n/lnmmzznze6qxo0ddc4ajydmzur-2xcfh-large.jpg '),
(10, '1,211', 'B2', '8B', 'Economy', '1:09 PM November 8', 'Rome(FCO)', '9:10 AM November 9', 'http://www.telegraph.co.uk/content/dam/video_previews/l/n/lnmmzznze6qxo0ddc4ajydmzur-2xcfh-large.jpg '),
(11, '143', 'C10', '12E', 'Economy', '7:15 AM September 13', 'New York(LGA)', '9:24 AM September 13', 'https://5d48184523c8a489ed05-91a4b8ed85c04e5358f91889505a4163.ssl.cf1.rackcdn.com/51/4/large.jpg '),
(12, '465', 'B1', '28C', 'First', '11:50 AM October 10', 'New York(LGA)', '1:49 PM October 10', 'https://5d48184523c8a489ed05-91a4b8ed85c04e5358f91889505a4163.ssl.cf1.rackcdn.com/51/4/large.jpg '),
(13, '916', 'B4', '12A', 'Economy', '6:00 AM September 13', 'Kahului(OGG)', '12:17 PM September 13', 'http://www.onlyinmaui.com/images/westin-maui.jpg'),
(14, '2,456', 'A9', '19A', 'First', '7:34 AM June 21', 'Kahului(OGG)', '5:13 PM June 21', 'http://www.onlyinmaui.com/images/westin-maui.jpg'),
(15, '2,908', 'C2', '9B', 'Economy', '3:40 PM June 21', 'Cape Town(CPT)', '10:00 AM June 22', 'https://capetown-airport.co.za/wp-content/uploads/2016/03/capetownairporthome.jpg '),
(16, '4,654', 'A3', '29C', 'Economy', '12:02 PM June 26', 'Cape Town(CPT)', '10:00 AM  June 27', 'https://capetown-airport.co.za/wp-content/uploads/2016/03/capetownairporthome.jpg '),
(17, '17,363', 'A9', '28B', 'First', '3:45 PM May 16', 'Sydney(SYD)', '7:15 AM May 17', 'http://cdn.traveler.es/uploads/images/thumbs/201149/sidney_7089_966x.jpg '),
(18, '1,743', 'D1', '12D', 'Economy', '12:34 PM May 21', 'Sydney(SYD)', '7:15 AM May 22', 'http://cdn.traveler.es/uploads/images/thumbs/201149/sidney_7089_966x.jpg '),
(19, '521', 'B2', '12B', 'Economy', '6:10 AM June 7', 'Bozeman(BZN)', '1:04 PM June 7', 'https://perfectdestination.files.wordpress.com/2013/05/yellow_spring.jpg'),
(20, '1,205', 'C2', '12C', 'First', '6:10 AM June 11', 'Bozeman(BZN)', '11:57 AM June 11', 'https://perfectdestination.files.wordpress.com/2013/05/yellow_spring.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_fullname` varchar(150) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `role` int(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fullname`, `user_email`, `role`, `password`) VALUES
(1, 'dneri', 'Daniel Neri', 'dneri@yahoo.com', 1, 'neri'),
(2, 'eschrock', 'Eric Schrock', 'schrock@yahoo.com', 2, 'schrock'),
(3, 'Eschrock', 'Eric Schrock', 'something@gmail.com', 2, 'super'),
(4, 'admin', 'admin admin', 'admin@admin.com', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citydetails`
--
ALTER TABLE `citydetails`
  ADD PRIMARY KEY (`cityID`),
  ADD UNIQUE KEY `cityID` (`cityID`),
  ADD UNIQUE KEY `cityID_2` (`cityID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planeticket`
--
ALTER TABLE `planeticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `planeticket`
--
ALTER TABLE `planeticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
