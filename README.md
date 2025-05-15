# CON Writer

CON Writer is a web-based tool for generating Tennessee Certificates of Need (CON) for involuntary psychiatric commitment. This tool helps medical professionals, law enforcement officers, and mental health providers quickly generate properly formatted CON documents.

## Features

- **Privacy-Focused**: Fully HIPAA compliant in-browser PDF generator - no patient data is ever transmitted or stored on the server
- **Multiple User Modes**:
  - Physician version (index.php)
  - Law Enforcement/6401 version (le.php)
  - Mental Health Professional/MPA version (mpa.php)
- **Streamlined Process**: Simple form interface with preset options for common situations
- **Local Storage**: Saves provider details, county, transport method, and destination for faster completion
- **Signature Support**: Digital signature capability for legal document completion
- **Geolocation**: Optional county auto-detection based on location

## Getting Started

### Prerequisites

- Web server with PHP support
- Modern web browser

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/conwriter.git
   ```

2. Upload the files to your web server or place them in your local development environment.

3. No database setup required - the application runs entirely client-side with minimal server interaction.

4. Access the application through your web browser:
   ```
   https://yourdomain.com/conwriter/
   ```

## Usage

1. Select the appropriate version (Physician, Law Enforcement, or MPA)
2. Fill out the required patient information
3. Check the appropriate boxes for diagnostic criteria
4. Add additional details in the text fields
5. For LE and MPA versions, sign the document using the signature pad
6. Click "Create" to generate a PDF
7. Save the generated PDF to your device

## Data Privacy Validation

CON Writer has been designed with a strong focus on privacy protection and HIPAA compliance. Here's how patient data is kept secure:

### Client-Side Processing
- All form data processing occurs entirely within the user's browser
- The JavaScript-based PDF generation (using jsPDF) happens locally on the client device
- Form data never leaves the user's computer except for non-identifying analytics

### Technical Validation
- Network inspection: Using browser developer tools to monitor network traffic confirms no PHI is transmitted
- Code inspection: Review of JavaScript code confirms all PDF generation is client-side
- No database storage: The application has no database for storing patient information
- Minimal server interaction: The only server calls are for:
  - Loading the application files (HTML, CSS, JS)
  - Anonymous analytics (county, transport method, destination)
  - No PHI transmission

### Logging Policy
- The application logs only:
  - County selection (no patient identifiers)
  - Transport method selected (e.g., "Ambulance")
  - Destination type (e.g., "Psychiatric Facility")
  - IP address (for security purposes only)

### Local Storage
- Only provider information is stored in browser local storage for convenience
- Patient information is never stored, even in local storage
- The application generates PDFs directly for immediate download without server-side processing

### Audit and Compliance
- Regular code reviews ensure continued compliance with privacy standards
- No use of third-party analytics or tracking tools that might compromise data

## Project Structure

```
conwriter/
├── index.php        # Main entry point - Physician version
├── le.php           # Law Enforcement version
├── mpa.php          # Mental Health Professional version
├── css/             # Stylesheets
├── js/              # JavaScript files
│   ├── script.v4.js         # Main script
│   ├── script.le.v3.js      # LE script
│   ├── script.mpa.v4.js     # MPA script
│   └── ...
├── img/             # Image files
│   ├── 2024/        # Standard form images
│   ├── 2024/mpa24/  # MPA form images
│   └── new23/       # LE form images
└── ...
```

## License

© 2024 [Ben Smith, MD, FACEP](mailto:bensmith.md@gmail.com) - All Rights Reserved

## Developer Contact

For issues, questions, or suggestions, please contact:

Ben Smith, MD, FACEP  
Email: [bensmith.md@gmail.com](mailto:bensmith.md@gmail.com)

## Acknowledgments

- This tool is designed for authorized medical and law enforcement professionals in Tennessee
- Created to streamline the CON process while maintaining patient privacy
- No direct affiliation with any government agency

---

*Disclaimer: This tool does not constitute any form of medical advice. It is intended only for use by qualified professionals in accordance with Tennessee state laws regarding involuntary psychiatric commitment.*
