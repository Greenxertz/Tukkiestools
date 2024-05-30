# Use Ubuntu as the base image
FROM ubuntu:latest

ARG DEBIAN_FRONTEND=noninteractive

# Update the sources list to use the South African mirror
RUN sed -i 's|archive.ubuntu.com|ubuntu.mirror.ac.za|' /etc/apt/sources.list \
    && sed -i 's|security.ubuntu.com|ubuntu.mirror.ac.za|' /etc/apt/sources.list

# Install necessary packages
RUN apt-get update --fix-missing && apt-get install -y \
    curl \
    sudo \
    unzip \
    git \
    libicu-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Define arguments for user ID and group ID
ARG USER_ID
ARG GROUP_ID

# Create a group and user if they don't exist, while also logging
RUN groupadd -g $GROUP_ID myuser || echo "Group already exists" \
    && useradd -u $USER_ID -g $GROUP_ID -m -s /bin/bash myuser || echo "User already exists"

# Give 'myuser' sudo privileges
RUN echo "myuser ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/myuser

# Set proper permissions for the necessary directories
RUN mkdir -p /actions-runner/_diag && chown -R myuser:myuser /actions-runner /home/myuser

# Download and extract actions-runner
WORKDIR /actions-runner
RUN curl -o actions-runner.tar.gz -L https://github.com/actions/runner/releases/download/v2.314.1/actions-runner-linux-x64-2.314.1.tar.gz \
    && tar xzf actions-runner.tar.gz \
    && chown -R myuser:myuser /actions-runner

# Switch to the non-root user 'myuser'
USER myuser

# Install Packages
RUN sudo apt-get update && sudo apt-get install -y \
    xz-utils \
    jq

# Configure the GitHub Actions local runner with the provided token
ARG GITHUB_ACCESS_TOKEN
ARG RUNNER_NAME
RUN ./config.sh --url https://github.com/Greenxertz/Tukkiestools --token $GITHUB_ACCESS_TOKEN --name $RUNNER_NAME

# Specify the full path to the run.sh script
CMD ["./run.sh"]


# docker build -t private_runner --build-arg USER_ID=1000 --build-arg GROUP_ID=1000 --build-arg RUNNER_NAME=TUKKIES_LOCAL_RUNNER --build-arg GITHUB_ACCESS_TOKEN=BDOOMH7EBJSNJ3ENXD3X4BLGLCTCI .
#  And run
# docker run -d private_runner

