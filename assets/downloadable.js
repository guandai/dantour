import React, { Component, Fragment } from 'react'
import ReactDOM from "react-dom";
import Select from 'react-select';

class Downloadable extends Component {
    constructor(props) {
        super(props);
        this.props = props;
        this.state = {};
    }

    render() {
        const { options, selectedOptions, i18n } = wp_travel_downloads_localized;
        return (
            <div className="wp-travel-downloads-downloadable-email-attachments">
                <div className="wp-travel-tab-content-title tab_content_title">Downloadable Email Attachments</div>
                <Select
                    name="wp_travel_downloads[email_downloadable_attachments][]"
                    defaultValue={selectedOptions}
                    placeholder={i18n.downloadablePlaceholder}
                    options={options}
                    isMulti={true}
                    isSearchable={true}
                />
                <p className="howto">
                    All the downloads that you select from downloadable attachments field will be included in your booking email using this email tag:
                    <code>{"{wp_travel_downloads_email_attachments}"}</code>
                    The attachments will be dynamically attached to the booking email according to the trip.
                </p>
            </div>
        )
    }
}

const rootElement = document.getElementById("wp-travel-downloads-email-downloadable-attachments-inner");
ReactDOM.render(<Downloadable />, rootElement);
