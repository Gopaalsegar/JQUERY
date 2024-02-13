
import Menu from '../components/Menu';
import HeroSection from '../components/HeroSection';
import HeroSection2 from '../components/HeroSection2';

// import SlickSlider from '../components/SlickSlider';
import Footer from '../components/Footer';
// import SwipeSection from '../components/SwipeSection';
import BlackBox from '../components/BlackBox';
import ImageSection from "@/components/ImageSection";
import Carousel from '../components/Carousel';

import Header from '../components/Header';
import ImageGrid from "@/components/ImageGrid";
import ImageGrid2 from "@/components/ImageGrid2";


export default function Home() {
 
  const colors = ['#FF5733', '#33FF57', '#5733FF', '#FF33CC'];

  const images = [
    {
        id: 1,
        image: '/images/color-lib.png',
        heading: 'Color Libraries',
        description: ' Your creative teams will love working with Coloro’s designed-to-last libraries which are both <b>logical and beautifully designed</b>.',
      },
      {
        id: 2,
        image: '/images/datadigital.png',
        heading: 'Data & Digital Tools        ',
        description: 'Achieving colors becomes that much easier with Coloro’s <b> advanced feasibility data </b> and accurate standards (physical and digital).',
      },
      {
        id: 3,
        image: '/images/support.png',
        heading: 'Unrivaled Support        ',
        description: 'You’ll be fully supported with Coloro’s <b>here-to-help team </b>of experts - onboarding, technical questions, dye support, ordering, and more.',
      },
     
    ];
  return (
   <div>
    <Menu />

<Header />
<HeroSection backgroundImage='/images/bg.webp'/>
<ImageGrid />
<ImageGrid2 images={images}/>
<HeroSection2 
  backgroundImage="/images/bg2.webp"
  content={{
    title: "How We Help",
    heading: "Creative Teams",
    paragraph: "An intuitive and logical system that helps you find the color you need quickly.",
    buttonText: "Explore"
  }}
/>
{/* <HeroSection2 backgroundImage='/images/bg3.webp'/> */}
{/* <SlickSlider settings={settings} slides={slides} /> */}
{/* <SwipeSection slides={slides} /> */}
{/* <Carousel colors={colors} /> */}

<BlackBox
        heading="@Coloro_        "
        content="Check out the Coloro instagram for inspiration"
        buttonText="Explore"
      />
        <ImageSection
        backgroundImage="/images/bg4.webp"
        heading="Don’t wait,
        start now"
        content="“If your team is looking to add a color service – I highly recommend Coloro! They make our lives a lot easier. Super involved and easy to work with color service partner.” – Top 5 Outdoor brand"
        buttonText="Schedule a Call"
      />
{/* <SwipeSection data={swipeData} /> */}
<Footer />

   </div>
  );
}
