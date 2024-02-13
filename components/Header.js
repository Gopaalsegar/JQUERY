import React, { useEffect, useState } from 'react';
import styles from '../styles/Header.module.css';
import OvalButton from './OvalButton';

const Header = () => {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      setScrolled(scrollTop > 0);
    };

    window.addEventListener('scroll', handleScroll);

    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []);

  return (
    <div className={`${styles.header} ${scrolled ? styles.scrolled : ''}`}>
      <div className={styles.row}>
        <div className={styles.logo}>
          <img src="/images/logo-dark.svg" alt="Logo" />
          <div className={styles.menu}>
            <a href="/shop" className={styles.link}>How we help</a>
            <a href="/shop" className={styles.link}>The colour system</a>
            <a href="/shop" className={styles.link}>Products</a>
            <a href="/help" className={styles.link}>Our partners</a>
          </div>
        </div>
        <div className={styles.right}>
          <a href="/shop" className={styles.link}>Shop</a>
          <a href="/help" className={styles.link}>Workspace</a>
        </div>
        <OvalButton text="Get demo" />
      </div>
    </div>
  );
};

export default Header;
