// components/Footer.js
import React from 'react';
import styles from '../styles/Footer.module.css';

const Footer = () => {
  return (
    <footer className={styles.footer}>
      <div className={styles.footerContent}>
        <div className={styles.left}>
          <div className={styles.footerContact}>
            <p>Contact: contact@coloro.com</p>
            <div className={styles.socialLinks}>
              <a href="https://www.instagram.com">Instagram</a>
              <br />
              <a href="https://www.linkedin.com">LinkedIn</a>
              <br />
              <a href="https://www.youtube.com">YouTube</a>
            </div>
          </div>
        </div>
        <div className={styles.middle}>
          <div className={styles.newsletter}>
            <h2>Stay ahead</h2>
            <p>Sign up for our newsletter</p>
            <form>
              <input type="email" placeholder="e.g. youremail@yourcompany.com" />
              <button type="submit">Submit</button>
            </form>
          </div>
        </div>
        <div className={styles.right}>
        <h3>Affiliations and memberships</h3>

          <div className={styles.footerLinks}>
            <img src="/images/AATCC.png" alt="AATCC Material" />
            <img src="/images/SDC.png" alt="SDC Logo" />
          </div>
        </div>
      </div>
      <div className={styles.bottom}>
        <div className={styles.legal}>
          <div>
            <p>Privacy Policy</p>
            <p>Terms of Use</p>
            <p>Cookies Policy</p>
            <p>Purchase T&Cs</p>
          </div>
        </div>
        <div className={styles.backToTop}>
          <a href="#">Back to top</a>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
