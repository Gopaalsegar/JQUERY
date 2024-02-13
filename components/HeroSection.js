import React from 'react';
import styles from '../styles/HeroSection.module.css';

const HeroSection = ({ backgroundImage }) => {
  return (
    <section className={styles.hero} style={{ backgroundImage: `url(${backgroundImage})` }}>
      <div className={styles.center}>
        <div className={styles.content}>
          <div className={styles.left}>
            <h1>A new way to work with color</h1>
          </div>
          <div className={styles.right}>
            <p>Coloro is an innovative color system and partner for the design industry – supporting brands, retailers and their supply chains to improve creation, communication and execution of color.</p>
          </div>
        </div>
      </div>
    </section>
  );
};

export default HeroSection;
